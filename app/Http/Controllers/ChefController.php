<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ChefController extends Controller
{
    /**
     * ===============================
     * DASHBOARD CHEF
     * (Pesanan yang perlu dimasak)
     * ===============================
     */
    public function index()
    {
        $orders = Order::whereIn('status', ['pending', 'cooking'])
            ->with(['items.menu'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chief.dashboard', ['orders' => $orders]);
    }

    /**
     * ===============================
     * UPDATE STATUS MASAKAN
     * ===============================
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'pending') {
            $order->update(['status' => 'cooking']);
        } 
        elseif ($order->status === 'cooking') {
            $order->update(['status' => 'completed']);
        }

        return redirect()->back();
    }

    /**
     * ===============================
     * RIWAYAT PESANAN CHEF
     * (Sudah dimasak / sudah dibayar)
     * ===============================
     */
    public function history()
    {
        // Chef melihat pesanan yang sudah selesai dimasak atau sudah dibayar
        $orders = Order::where('status', 'completed')
            ->orWhere('status', 'paid')
            ->orderBy('updated_at', 'desc')
            ->take(50)
            ->get();

        return view('chief.history', compact('orders'));
        // Pastikan folder view: resources/views/chief/history.blade.php
    }
}
