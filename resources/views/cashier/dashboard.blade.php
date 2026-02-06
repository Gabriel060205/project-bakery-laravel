<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30"> 
    <title>Kasir - Bakery Delicious</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            💰 Kasir Area
        </h1>
        
        <div class="flex gap-3">
            <a href="{{ route('cashier.history') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition flex items-center gap-2">
                📜 Riwayat Transaksi
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600 transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-bold">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm font-bold">
                <tr>
                    <th class="p-4">Meja</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4 text-center">Waktu Hanya 3 Menit</th> <th class="p-4">Total</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-bold text-lg">Meja {{ $order->table_number }}</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800">{{ $order->customer_name }}</div>
                        <div class="text-sm text-gray-500">Kode: {{ $order->payment_code }}</div>
                    </td>
                    
                    <td class="p-4 text-center">
                        <div class="countdown-timer font-mono text-xl font-bold text-orange-600 bg-orange-100 px-3 py-1 rounded inline-block"
                             data-deadline="{{ $order->created_at->addMinutes(3)->timestamp * 1000 }}">
                            Memuat...
                        </div>
                    </td>

                    <td class="p-4 font-bold text-green-600 text-lg">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="p-4 text-center">
                        <form action="{{ route('cashier.confirm', $order->id) }}" method="POST" class="flex flex-col gap-2">
                            @csrf
                            <input type="text" name="note" placeholder="Catatan (Opsional)" class="border p-2 rounded text-sm w-full">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded font-bold hover:bg-green-700 shadow-md">
                                ✅ Konfirmasi Lunas
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500 italic">
                        Tidak ada antrian pembayaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Fungsi ini akan jalan setiap 1 detik
        setInterval(function() {
            // Ambil semua elemen yang punya class 'countdown-timer'
            let timers = document.querySelectorAll('.countdown-timer');

            timers.forEach(function(timer) {
                // Ambil waktu deadline dari atribut data-deadline
                let deadline = parseInt(timer.getAttribute('data-deadline'));
                let now = new Date().getTime();
                let distance = deadline - now;

                // Hitung menit dan detik
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Tambahkan nol di depan angka satuan (misal 5 jadi 05)
                if (seconds < 10) seconds = "0" + seconds;

                // Tampilkan hasil
                if (distance > 0) {
                    timer.innerHTML = minutes + ":" + seconds;
                    
                    // Kalau sisa kurang dari 1 menit, ubah warna jadi Merah berkedip
                    if (minutes == 0) {
                        timer.classList.remove('text-orange-600', 'bg-orange-100');
                        timer.classList.add('text-red-600', 'bg-red-100', 'animate-pulse');
                    }
                } else {
                    // Kalau waktu habis
                    timer.innerHTML = "Gagal Bayar";
                    timer.classList.remove('text-orange-600', 'bg-orange-100', 'animate-pulse');
                    timer.classList.add('text-gray-500', 'bg-gray-200');
                    // Nanti sistem auto-cancel (refresh halaman) akan menghapus baris ini
                }
            });
        }, 1000); // 1000 milidetik = 1 detik
    </script>

</body>
</html>