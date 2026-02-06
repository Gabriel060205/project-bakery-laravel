<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer|min:0',
            'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('menus', 'public');

        Menu::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer|min:0',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|integer|min:0',
        
        ]);

        $data = [
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }

            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        try {
            // Hapus gambar jika ada
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->delete();

            return redirect()
                ->route('menus.index')
                ->with('success', 'Menu berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Integrity constraint violation
            if ($e->getCode() == "23000") {
                return redirect()
                    ->back()
                    ->with('error', 'Gagal menghapus! Menu ini sudah pernah dipesan oleh pelanggan. Silakan edit saja.');
            }

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
