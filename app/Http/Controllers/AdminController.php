<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // ===============================
        // 1. STATISTIK HEADER
        // ===============================
        $totalMenus = Menu::count();
        $totalStaff = User::where('role', '!=', 'customer')->count();

        // ===============================
        // 2. PENDAPATAN HARI INI (LIVE)
        // ===============================
        $todayIncome = Order::whereDate('created_at', now()->today())
            ->where('status', '!=', 'unpaid')
            ->sum('total_price');

        // ===============================
        // 3. LIVE MONITORING TRANSAKSI (HARI INI)
        // ===============================
        $todaysOrders = Order::whereDate('created_at', now()->today())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // ===============================
        // 4. PENCARIAN RIWAYAT BERDASARKAN TANGGAL (BARU)
        // ===============================
        $selectedDate  = $request->date; // dari input kalender
        $historyOrders = [];
        $historyTotal  = 0;

        if ($selectedDate) {
            // Ambil semua transaksi di tanggal tersebut
            $historyOrders = Order::whereDate('created_at', $selectedDate)
                ->orderBy('created_at', 'desc')
                ->get();

            // Hitung total pendapatan (exclude unpaid & cancelled)
            $historyTotal = Order::whereDate('created_at', $selectedDate)
                ->where('status', '!=', 'unpaid')
                ->where('status', '!=', 'cancelled')
                ->sum('total_price');
        }

        // ===============================
        // 5. KIRIM KE VIEW
        // ===============================
        return view('admin.dashboard', compact(
            'totalMenus',
            'totalStaff',
            'todayIncome',
            'todaysOrders',
            'historyOrders',
            'selectedDate',
            'historyTotal'
        ));
    }
}
