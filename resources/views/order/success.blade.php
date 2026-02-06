<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <div class="text-green-500 text-6xl mb-4">✅</div>

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Pesanan Diterima!
        </h1>

        <p class="text-gray-600 mb-6">
            Mohon tunggu, pesanan Anda sedang disiapkan oleh Chef kami.
        </p>

        <!-- INFO PESANAN -->
        <div class="bg-gray-100 p-4 rounded text-left mb-6">
            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>Meja:</strong> {{ $order->table_number }}</p>

            @php
                $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
                $discount = $order->voucher_code ? ($subtotal - $order->total_price) : 0;
            @endphp

            <div class="mt-4 border-t pt-4">
                @if($order->voucher_code)
                    <div class="flex justify-between text-green-600 font-bold">
                        <span>Diskon Voucher ({{ $order->voucher_code }})</span>
                        <span>- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                    </div>
                @endif

                <div class="flex justify-between text-xl font-black mt-2 text-orange-600">
                    <span>Total Bayar</span>
                    <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('order.index', $order->table_number) }}"
           class="block bg-orange-500 text-white py-2 rounded hover:bg-orange-600 font-bold">
            Pesan Lagi
        </a>
    </div>

    <!-- KODE PEMBAYARAN -->
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-6 max-w-md w-full">
        <p class="font-bold">Silakan bayar ke Kasir dengan kode:</p>
        <p class="text-4xl font-black tracking-widest mt-2 text-center">
            {{ $order->payment_code }}
        </p>
        <p class="text-sm mt-2 text-red-600">
            *Pesanan tidak akan dimasak sebelum dibayar.
        </p>
    </div>

</body>
</html>
