<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    // Tampilkan Daftar Meja
    public function index()
    {
        $tables = Table::orderBy('number', 'asc')->get();
        return view('admin.tables.index', compact('tables'));
    }

    // Simpan Meja Baru
    public function store(Request $request)
    {
        $request->validate(['number' => 'required|unique:tables']);
        
        Table::create(['number' => $request->number]);
        
        return redirect()->back()->with('success', 'Meja berhasil ditambahkan!');
    }

    // Hapus Meja
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->back()->with('success', 'Meja dihapus!');
    }
}