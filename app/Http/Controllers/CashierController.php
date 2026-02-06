<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;
use App\Models\Menu;

class CashierController extends Controller
{
    /**
     * ===============================
     * DASHBOARD KASIR
     * (Pesanan belum dibayar + AUTO CANCEL)
     * ===============================
     */
    public function index()
    {
        // ===============================
        // AUTO CANCEL ORDER EXPIRED (> 3 MENIT)
        // ===============================
        $expiredOrders = Order::where('status', 'unpaid')
            ->where('created_at', '<', now()->subMinutes(3)) // lebih dari 3 menit
            ->with('items')
            ->get();

        foreach ($expiredOrders as $order) {

            // 1. KEMBALIKAN STOK MENU
            foreach ($order->items as $item) {
                $menu = Menu::find($item->menu_id);
                if ($menu) {
                    $menu->increment('stock', $item->quantity);
                }
            }

            // 2. KOSONGKAN MEJA
            $table = Table::where('number', $order->table_number)->first();
            if ($table) {
                $table->update(['status' => 'available']);
            }

            // 3. CANCEL ORDER
            $order->update(['status' => 'cancelled']);
        }

        // ===============================
        // TAMPILKAN ORDER UNPAID AKTIF
        // ===============================
        $orders = Order::where('status', 'unpaid')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cashier.dashboard', ['orders' => $orders]);
    }

        /**
        * ===============================
        * KONFIRMASI PEMBAYARAN
        * ===============================
        */
        public function confirmPayment(Request $request, $id)
        {
            $order = Order::findOrFail($id);

            // 1. UPDATE PESANAN → MASUK DAPUR
            $order->update([
                'status'           => 'pending',
                'transaction_note' => $request->note,
            ]);

            // 2. KOSONGKAN MEJA
            $table = Table::where('number', $order->table_number)->first();
            if ($table) {
                $table->update(['status' => 'available']);
            }

            return redirect()
                ->back()
                ->with('success', 'Pembayaran diterima & Meja dikosongkan!');
        }

        /**
        * ===============================
        * RIWAYAT TRANSAKSI KASIR
        * ===============================
        */
        public function history()
        {
            $orders = Order::whereIn('status', ['paid', 'completed'])
                ->orderBy('updated_at', 'desc')
                ->take(50)
                ->get();

            return view('cashier.history', compact('orders'));
        }   
}
