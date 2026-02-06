<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-orange-600 mb-6">Bakery Delicious</h1>
        <p class="text-center mb-4 text-gray-600">Anda duduk di <strong>Meja {{ $no_meja }}</strong></p>

        <form action="{{ route('order.start') }}" method="POST">
            @csrf
            <input type="hidden" name="table_number" value="{{ $no_meja }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Pelanggan</label>
                <input type="text" name="customer_name" required class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-orange-400" placeholder="Nama Anda">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nomor Telepon</label>
                <input type="number" name="phone_number" required class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-orange-400" placeholder="Contoh: 081234567890">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Kode Promo (Opsional)</label>
                <input type="text" name="voucher_code" class="w-full border p-3 rounded-lg bg-gray-50 uppercase" placeholder="Masukan Kode Promo Jika Ada">
            </div>

            <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 font-bold shadow-lg transition duration-200">
                Lanjut Pesan Menu ➡️
            </button>
        </form>
    </div>

</body>
</html>