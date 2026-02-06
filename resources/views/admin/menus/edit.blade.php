<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-xl mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Menu</h1>

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAMA MENU -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="w-full border p-2 rounded" required>
            </div>

            <!-- ✅ KATEGORI (UPDATED) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="category" class="w-full border p-2 rounded bg-gray-50 focus:ring-2 focus:ring-blue-500">
                    <option value="Makanan" {{ $menu->category == 'Makanan' ? 'selected' : '' }}>
                        🍔 Makanan
                    </option>
                    <option value="Minuman" {{ $menu->category == 'Minuman' ? 'selected' : '' }}>
                        🥤 Minuman
                    </option>
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Ubah kategori lama ke Makanan / Minuman jika perlu.
                </p>
            </div>

            <!-- HARGA -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $menu->price }}" class="w-full border p-2 rounded" required>
            </div>

            <!-- STOK & DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stok Tersedia</label>
                <input type="number" name="stock" value="{{ $menu->stock }}" class="w-full border p-2 rounded" required min="0">

                <label class="block text-gray-700 font-bold mb-2 mt-4">Deskripsi</label>
                <textarea name="description" class="w-full border p-2 rounded">{{ $menu->description }}</textarea>
            </div>

            <!-- FOTO -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Ganti Foto (Opsional)</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $menu->image) }}" class="w-20 h-20 rounded object-cover border">
                </div>
                <input type="file" name="image" class="w-full border p-2 rounded bg-gray-50">
                <p class="text-xs text-gray-500 mt-1">
                    Biarkan kosong jika tidak ingin mengganti foto.
                </p>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between">
                <a href="{{ route('menus.index') }}" class="text-gray-600 font-bold py-2">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">
                    Update Menu
                </button>
            </div>
        </form>
    </div>

</body>
</html>
