<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Dapur - Chef Area</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            👨‍🍳 Chef Area (Dapur)
        </h1>

        <div class="flex gap-3">
            <a href="{{ route('chief.history') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition flex items-center gap-2">
                📜 Riwayat Masakan
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($orders as $order)
        <div class="bg-white rounded-xl shadow-lg border-l-4 border-orange-500 overflow-hidden">
            <div class="bg-orange-50 p-4 flex justify-between items-center border-b">
                <div>
                    <h2 class="font-bold text-lg text-gray-800">Meja {{ $order->table_number }}</h2>
                    <p class="text-sm text-gray-600">{{ $order->customer_name }}</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold bg-orange-200 text-orange-800 px-2 py-1 rounded">
                        {{ $order->created_at->format('H:i') }}
                    </span>
                </div>
            </div>

            <div class="p-4">
                <ul class="space-y-2 mb-4">
                    @foreach($order->items as $item)
                    <li class="flex justify-between items-center border-b pb-2">
                        <span class="font-bold text-gray-700">{{ $item->menu->name }}</span>
                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs font-bold">
                            x{{ $item->quantity }}
                        </span>
                    </li>
                    @endforeach
                </ul>

                @if($order->transaction_note)
                <div class="bg-yellow-50 p-2 rounded text-sm text-yellow-800 mb-4 border border-yellow-200">
                    📝 Catatan: {{ $order->transaction_note }}
                </div>
                @endif

                <form action="{{ route('chief.update', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700 transition shadow">
                        ✅ Selesai Masak
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20">
            <div class="text-gray-400 text-6xl mb-4">🍳</div>
            <p class="text-gray-500 text-xl font-bold">Belum ada pesanan masuk.</p>
            <p class="text-gray-400">Santai dulu, Chef!</p>
        </div>
        @endforelse
    </div>

</body>
</html>