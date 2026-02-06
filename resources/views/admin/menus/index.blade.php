<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🥐 Daftar Menu</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅ Dashboard</a>
            <a href="{{ route('menus.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 font-bold">+ Tambah Menu</a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-sm">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">

            {{-- ===== THEAD (UPDATED) ===== --}}
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-4">Foto</th>
                    <th class="p-4">Nama Menu</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            {{-- ===== TBODY (UPDATED) ===== --}}
            <tbody>
                @forelse($menus as $menu)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="w-16 h-16 object-cover rounded shadow-sm">
                        @else
                            <span class="text-gray-400 italic text-xs">No Image</span>
                        @endif
                    </td>

                    <td class="p-4 font-bold text-gray-700">
                        {{ $menu->name }}
                    </td>

                    <td class="p-4">
                        <span class="bg-orange-100 text-orange-600 text-xs px-2 py-1 rounded-full uppercase font-bold">
                            {{ $menu->category }}
                        </span>
                    </td>

                    <td class="p-4">
                        @if($menu->stock == 0)
                            <span class="text-red-600 font-bold bg-red-100 px-2 py-1 rounded text-xs">HABIS</span>
                        @elseif($menu->stock < 5)
                            <span class="text-red-500 font-bold">{{ $menu->stock }} (Menipis)</span>
                        @else
                            <span class="text-green-600 font-bold">{{ $menu->stock }}</span>
                        @endif
                    </td>

                    <td class="p-4 font-bold">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </td>

                    <td class="p-4 text-center space-x-2">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline font-bold text-sm">
                            Edit
                        </a>

                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus menu ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-bold text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        Belum ada menu.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</body>
</html>
