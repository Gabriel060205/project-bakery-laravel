<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers|uppercase', 
            'amount' => 'required|integer|min:1000',
        ]);

        Voucher::create($request->all());

        return redirect()->back()->with('success', 'Voucher berhasil dibuat!');
    }

    public function destroy($id)
    {
        Voucher::destroy($id);
        return redirect()->back()->with('success', 'Voucher dihapus!');
    }
}