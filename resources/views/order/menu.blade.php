<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Agar scrollbar tidak jelek di browser */
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen pb-24">

    <div class="bg-orange-600 p-4 sticky top-0 z-50 shadow-md">
        <div class="flex justify-between items-center text-white max-w-6xl mx-auto">
            <div>
                <h1 class="text-xl font-bold flex items-center gap-2">
                    🥐 Bakery Delicious
                </h1>
                <p class="text-xs text-orange-200 mt-1">
                    Meja {{ session('table_number') }} • {{ session('customer_name') }}
                </p>
            </div>
            @if(session('voucher'))
            <div class="bg-white text-orange-600 px-3 py-1 rounded-full text-xs font-bold shadow animate-bounce">
                🎟️ {{ session('voucher') }}
            </div>
            @endif
        </div>
    </div>

    @if(session('error'))
    <div class="bg-red-500 text-white p-3 text-center text-sm font-bold sticky top-16 z-40 shadow">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('order.checkout') }}" method="POST" class="p-4 max-w-6xl mx-auto">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <div>
                <div class="bg-orange-100 text-orange-800 p-3 rounded-lg mb-4 font-bold text-lg flex items-center gap-2 border border-orange-200 sticky top-20 z-30">
                    🍔 Makanan
                </div>

                <div class="space-y-4">
                    @php $hasFood = false; @endphp
                    @foreach($menus as $menu)
                        @if($menu->category == 'Makanan' || ($menu->category != 'Minuman' && $menu->category != 'Makanan')) 
                        @php $hasFood = true; @endphp
                        
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex gap-4 items-center hover:shadow-md transition">
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border">
                                @if($menu->image)
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 text-xs text-center p-1">No Image</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $menu->name }}</h3>
                                <div class="mt-1">
                                    <span class="inline-flex items-center bg-orange-100 text-orange-700 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">
                                        🍔 Makanan
                                    </span>
                                </div>
                                <p class="text-orange-600 font-bold mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $menu->description }}</p>
                                <p class="text-xs mt-1 font-bold {{ $menu->stock < 5 ? 'text-red-500' : 'text-green-600' }}">
                                    Stok: {{ $menu->stock }}
                                </p>
                            </div>

                            <div class="w-16">
                                <input type="number" name="items[{{ $menu->id }}]" 
                                       value="0" min="0" max="{{ $menu->stock }}" 
                                       class="w-full border rounded-lg p-2 text-center text-lg font-bold focus:ring-2 focus:ring-orange-500 bg-gray-50">
                            </div>
                        </div>
                        @endif
                    @endforeach

                    @if(!$hasFood)
                        <div class="text-center p-8 text-gray-400 bg-white rounded-lg border border-dashed">
                            Belum ada menu makanan.
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <div class="bg-blue-100 text-blue-800 p-3 rounded-lg mb-4 font-bold text-lg flex items-center gap-2 border border-blue-200 sticky top-20 z-30">
                    🥤 Minuman
                </div>

                <div class="space-y-4">
                    @php $hasDrink = false; @endphp
                    @foreach($menus as $menu)
                        @if($menu->category == 'Minuman')
                        @php $hasDrink = true; @endphp

                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex gap-4 items-center hover:shadow-md transition">
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border">
                                @if($menu->image)
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 text-xs text-center p-1">No Image</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $menu->name }}</h3>
                                <div class="mt-1">
                                    <span class="inline-flex items-center bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">
                                        🥤 Minuman
                                    </span>
                                </div>
                                <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $menu->description }}</p>
                                <p class="text-xs mt-1 font-bold {{ $menu->stock < 5 ? 'text-red-500' : 'text-green-600' }}">
                                    Stok: {{ $menu->stock }}
                                </p>
                            </div>

                            <div class="w-16">
                                <input type="number" name="items[{{ $menu->id }}]" 
                                       value="0" min="0" max="{{ $menu->stock }}" 
                                       class="w-full border rounded-lg p-2 text-center text-lg font-bold focus:ring-2 focus:ring-blue-500 bg-gray-50">
                            </div>
                        </div>
                        @endif
                    @endforeach

                    @if(!$hasDrink)
                        <div class="text-center p-8 text-gray-400 bg-white rounded-lg border border-dashed">
                            Belum ada menu minuman.
                        </div>
                    @endif
                </div>
            </div>

        </div> 
        <div class="fixed bottom-0 left-0 w-full bg-white p-4 border-t shadow-[0_-5px_10px_rgba(0,0,0,0.1)] z-50">
            <div class="max-w-6xl mx-auto flex justify-between items-center gap-4">
                <div class="text-sm text-gray-500 hidden md:block">
                    Pastikan pesanan sudah benar sebelum konfirmasi.
                </div>
                <button type="submit" class="w-full md:w-auto md:px-12 bg-orange-600 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-orange-700 transition transform active:scale-95 text-lg flex justify-center items-center gap-2">
                    🛒 Konfirmasi Pesanan
                </button>
            </div>
        </div>
    </form>

</body>
</html>