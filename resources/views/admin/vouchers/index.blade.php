<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">🎟️ Voucher Promo</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:underline">Kembali ke Dashboard</a>
        </div>

        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="font-bold mb-4">Buat Voucher Baru</h2>
            <form action="{{ route('vouchers.store') }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="code" placeholder="Kode (Misal: DISKON50)" class="border p-2 rounded w-1/2 uppercase" required>
                <input type="number" name="amount" placeholder="Nominal (Rp)" class="border p-2 rounded w-1/3" required>
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded font-bold">Simpan</button>
            </form>
        </div>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-4">Kode Promo</th>
                        <th class="p-4">Potongan (Rp)</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $v)
                    <tr class="border-b">
                        <td class="p-4 font-mono font-bold text-blue-600">{{ $v->code }}</td>
                        <td class="p-4">Rp {{ number_format($v->amount) }}</td>
                        <td class="p-4 text-right">
                            <form action="{{ route('vouchers.destroy', $v->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-bold hover:underline">Hapus</button>
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