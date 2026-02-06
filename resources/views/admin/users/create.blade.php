<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Staff Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Karyawan Baru</h1>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required placeholder="Contoh: Budi Santoso">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email Login</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required placeholder="budi@bakery.com">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required placeholder="Minimal 6 karakter">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Jabatan (Role)</label>
                <select name="role" class="w-full border p-2 rounded bg-gray-50">
                    <option value="cashier">Kasir (Cashier)</option>
                    <option value="chief">Koki (Chef)</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('users.index') }}" class="text-gray-500 font-bold">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

</body>
</html>