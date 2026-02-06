<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-xl mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Menu Baru</h1>

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- NAMA MENU -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <!-- ✅ KATEGORI (UPDATED) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="category" class="w-full border p-2 rounded bg-gray-50 focus:ring-2 focus:ring-blue-500">
                    <option value="Makanan">🍔 Makanan</option>
                    <option value="Minuman">🥤 Minuman</option>
                </select>
            </div>

            <!-- HARGA & STOK -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" class="w-full border p-2 rounded" required>

                <label class="block text-gray-700 font-bold mb-2 mt-4">Stok Awal</label>
                <input type="number" name="stock" class="w-full border p-2 rounded" required min="0">
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" class="w-full border p-2 rounded"></textarea>
            </div>

            <!-- FOTO -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Foto Menu</label>
                <input type="file" name="image" class="w-full border p-2 rounded bg-gray-50" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks 2MB.</p>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between">
                <a href="{{ route('menus.index') }}" class="text-gray-600 font-bold py-2">
                    Batal
                </a>
                <button type="submit"
                        class="bg-orange-600 text-white px-6 py-2 rounded font-bold hover:bg-orange-700">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>

</body>
</html>
