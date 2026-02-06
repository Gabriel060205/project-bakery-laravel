<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">🕰️ Riwayat Pesanan</h1>
        @if(auth()->user()->role == 'cashier')
            <a href="{{ route('cashier.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Kembali ke Dashboard</a>
        @else
            <a href="{{ route('chief.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Kembali ke Dashboard</a>
        @endif
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Meja</th>
                    <th class="p-3">Pelanggan</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b">
                    <td class="p-3">{{ $order->updated_at->format('d M H:i') }}</td>
                    <td class="p-3">Meja {{ $order->table_number }}</td>
                    <td class="p-3">{{ $order->customer_name }}</td>
                    <td class="p-3">Rp {{ number_format($order->total_price) }}</td>
                    <td class="p-3">
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">
                            {{ strtoupper($order->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-4 text-center">Belum ada riwayat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>