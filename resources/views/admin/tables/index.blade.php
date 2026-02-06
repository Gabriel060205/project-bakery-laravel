<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Meja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">🪑 Manajemen Meja</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:underline">
                Kembali ke Dashboard
            </a>
        </div>

        <!-- TAMBAH MEJA -->
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="font-bold mb-4">Tambah Meja Baru</h2>
            <form action="{{ route('tables.store') }}" method="POST" class="flex gap-4">
                @csrf
                <input
                    type="text"
                    name="number"
                    placeholder="Nomor Meja (Contoh: 1, 12, VIP)"
                    class="border p-2 rounded w-full"
                    required
                >
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold">
                    Simpan
                </button>
            </form>
        </div>

        <!-- DAFTAR MEJA -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-4">Nomor Meja</th>
                        <th class="p-4">Status Saat Ini</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $t)
                    <tr class="border-b">
                        <td class="p-4 font-bold text-xl text-gray-800">
                            {{ $t->number }}
                        </td>

                        <!-- ===============================
                             STATUS MEJA (UPDATED)
                             =============================== -->
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                {{ $t->status == 'occupied'
                                    ? 'bg-red-500 text-white'
                                    : 'bg-green-100 text-green-800' }}">
                                {{ $t->status == 'occupied' ? 'Terisi' : 'Kosong' }}
                            </span>
                        </td>

                        <td class="p-4 text-right">
                            <form
                                action="{{ route('tables.destroy', $t->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus meja ini?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 font-bold hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
