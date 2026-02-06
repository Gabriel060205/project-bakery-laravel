<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Staff - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">👥 Daftar Karyawan</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅ Dashboard</a>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-bold">+ Tambah Staff</a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">⚠️ {{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Role (Jabatan)</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold">{{ $user->name }}</td>
                    <td class="p-4 text-gray-600">{{ $user->email }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $user->role == 'chief' ? 'bg-orange-100 text-orange-700' : '' }}
                            {{ $user->role == 'cashier' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin pecat karyawan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>