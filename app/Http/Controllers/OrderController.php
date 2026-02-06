<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use App\Models\Table;

class OrderController extends Controller
{
    public function index($no_meja)
    {
        $table = Table::where('number', $no_meja)->first();

        if (!$table) {
            abort(404, 'Maaf, meja ini tidak terdaftar di sistem kami.');
        }

        return view('order.index', ['no_meja' => $no_meja]);
    }

    public function startOrder(Request $request)
    {
        // ===============================
        // 1. VALIDASI INPUT
        // ===============================
        $request->validate([
            'customer_name' => 'required',
            'table_number'  => 'required',
        ]);

        // ===============================
        // 2. UPDATE STATUS MEJA -> OCCUPIED
        // ===============================
        $table = Table::where('number', $request->table_number)->first();
        if ($table) {
            $table->update(['status' => 'occupied']);
        }

        // ===============================
        // 3. SIMPAN DATA KE SESSION
        // ===============================
        session([
            'customer_name' => $request->customer_name,
            'phone_number'  => $request->phone_number,
            'table_number'  => $request->table_number,
        ]);

        // ===============================
        // 4. CEK VOUCHER (JIKA DIISI)
        // ===============================
        if ($request->voucher_code) {
            $voucher = Voucher::where('code', $request->voucher_code)->first();

            if ($voucher) {
                session([
                    'voucher'  => $voucher->code,
                    'discount' => $voucher->amount,
                ]);
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Kode voucher tidak valid!');
            }
        } else {
            session()->forget(['voucher', 'discount']);
        }

        return redirect()->route('order.menu');
    }

    public function showMenu()
    {
        $menus = Menu::where('stock', '>', 0)->get();
        return view('order.menu', ['menus' => $menus]);
    }

    public function checkout(Request $request)
    {
        // ===============================
        // 1. CEK STOK DULU
        // ===============================
        foreach ($request->items as $menuId => $quantity) {
            if ($quantity > 0) {
                $menu = Menu::find($menuId);

                if (!$menu) {
                    return redirect()->back()->with('error', 'Menu tidak ditemukan.');
                }

                if ($menu->stock < $quantity) {
                    return redirect()
                        ->back()
                        ->with('error', "Maaf, stok {$menu->name} tidak cukup! Sisa: {$menu->stock}");
                }
            }
        }

        // ===============================
        // 2. BUAT ORDER
        // ===============================
        $paymentCode = 'PAY-' . strtoupper(Str::random(5));

        $order = Order::create([
            'customer_name' => session('customer_name'),
            'phone_number'  => session('phone_number'),
            'table_number'  => session('table_number'),
            'voucher_code'  => session('voucher'),
            'status'        => 'unpaid',
            'payment_code'  => $paymentCode,
            'total_price'   => 0,
        ]);

        $totalPrice = 0;

        // ===============================
        // 3. SIMPAN ITEM + KURANGI STOK
        // ===============================
        foreach ($request->items as $menuId => $quantity) {
            if ($quantity > 0) {
                $menu = Menu::find($menuId);

                $subtotal = $menu->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id'  => $menu->id,
                    'quantity' => $quantity,
                    'price'    => $menu->price,
                ]);

                // Kurangi stok
                $menu->decrement('stock', $quantity);

                $totalPrice += $subtotal;
            }
        }

        // ===============================
        // 4. HITUNG DISKON
        // ===============================
        $discount   = session('discount', 0);
        $finalPrice = $totalPrice - $discount;

        if ($finalPrice < 0) {
            $finalPrice = 0;
        }

        $order->update([
            'total_price'  => $finalPrice,
            'voucher_code' => session('voucher'),
        ]);

        // ===============================
        // 5. BERSIHKAN SESSION
        // ===============================
        session()->forget([
            'customer_name',
            'phone_number',
            'table_number',
            'voucher',
            'discount',
        ]);

        return redirect()->route('order.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('order.success', ['order' => $order]);
    }
}
