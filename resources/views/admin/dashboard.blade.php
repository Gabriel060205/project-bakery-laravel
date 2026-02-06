<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-800 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-bold mb-8 text-orange-500">Bakery Admin</h1>
        <nav class="space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 bg-gray-700 rounded">🏠 Dashboard</a>
            <a href="{{ route('menus.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded text-gray-300">🥐 Kelola Menu</a>
            <a href="{{ route('users.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded text-gray-300">👥 Kelola Staff</a>
            <a href="{{ route('vouchers.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded text-gray-300">🎟️ Voucher</a>
            <a href="{{ route('tables.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded text-gray-300">🪑 Kelola Meja</a>

            <form method="POST" action="{{ route('logout') }}" class="mt-8 border-t border-gray-700 pt-4">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-300 w-full text-left">
                    Log Out
                </button>
            </form>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Overview Hari Ini</h2>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow border-l-4 border-orange-500">
                <h3 class="text-gray-500">Total Menu</h3>
                <p class="text-3xl font-bold">{{ $totalMenus }} Item</p>
            </div>
            <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
                <h3 class="text-gray-500">Staff Aktif</h3>
                <p class="text-3xl font-bold">{{ $totalStaff }} Orang</p>
            </div>
            <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
                <h3 class="text-gray-500">Pendapatan Hari Ini</h3>
                <p class="text-3xl font-bold">
                    Rp {{ number_format($todayIncome, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- LIVE MONITORING -->
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                🔴 Live Monitoring Transaksi (Hari Ini)
            </h2>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-3">Jam</th>
                            <th class="p-3">Meja</th>
                            <th class="p-3">Pelanggan</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($todaysOrders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 text-gray-500 text-sm">
                                {{ $order->created_at->format('H:i') }}
                            </td>
                            <td class="p-3 font-bold">Meja {{ $order->table_number }}</td>
                            <td class="p-3">
                                <div class="font-bold">{{ $order->customer_name }}</div>
                                <div class="text-xs text-gray-400">{{ $order->payment_code }}</div>
                            </td>
                            <td class="p-3">
                                @if($order->status == 'unpaid')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-bold animate-pulse">
                                        ⏳ Menunggu Bayar
                                    </span>
                                @elseif($order->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">
                                        💰 Sudah Bayar (Menunggu Masak)
                                    </span>
                                @elseif($order->status == 'cooking')
                                    <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-bold">
                                        🔥 Sedang Dimasak
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">
                                        ✅ Selesai
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded text-xs font-bold">
                                        ❌ Gagal / Dibatalkan
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold uppercase">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-right font-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">
                                Belum ada transaksi hari ini. 🍃
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ===============================
             ARSIP RIWAYAT TRANSAKSI
             =============================== -->
        <div class="my-12 border-t-4 border-gray-200"></div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                📅 Arsip Riwayat Transaksi
            </h2>

            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 font-bold mb-2">Pilih Tanggal:</label>
                        <input type="date" name="date" value="{{ $selectedDate }}"
                               class="w-full border p-2 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow">
                        🔍 Cari Data
                    </button>

                    @if($selectedDate)
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 font-bold underline text-sm pb-2">
                        Reset
                    </a>
                    @endif
                </form>
            </div>

            @if($selectedDate)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                    <h3 class="font-bold text-blue-800">
                        Hasil Laporan Tanggal:
                        {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
                    </h3>
                    <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-bold">
                        Total Pendapatan: Rp {{ number_format($historyTotal, 0, ',', '.') }}
                    </span>
                </div>

                <table class="w-full text-left">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="p-3">Jam</th>
                            <th class="p-3">Meja</th>
                            <th class="p-3">Pelanggan</th>
                            <th class="p-3">Status Akhir</th>
                            <th class="p-3 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historyOrders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $order->created_at->format('H:i') }}</td>
                            <td class="p-3 font-bold">Meja {{ $order->table_number }}</td>
                            <td class="p-3">
                                <div>{{ $order->customer_name }}</div>
                                <div class="text-xs text-gray-400">{{ $order->payment_code }}</div>
                            </td>
                            <td class="p-3">
                                @if($order->status == 'completed')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">✅ Selesai</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded text-xs font-bold">❌ Dibatalkan</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold uppercase">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-right font-bold text-gray-700">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500 italic">
                                Tidak ada transaksi pada tanggal ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <div class="pb-10"></div>

    </main>
</div>

</body>
</html>
