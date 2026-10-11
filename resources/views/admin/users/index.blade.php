@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-navy">Manajemen Pengguna Sistem</h2>
            <p class="text-xs text-gray-500">Kelola akun Super Admin, Kepala Sekolah, Guru, Staf TU, dan Siswa.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-emerald text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition">
            + Tambah Pengguna Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 text-xs rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-800 text-xs rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-navy uppercase bg-offwhite border-b">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role / Hak Akses</th>
                    <th class="px-4 py-3">NIP / NISN</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-navy">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs font-semibold bg-gold/20 text-navy rounded uppercase">
                                {{ str_replace('_', ' ', $user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $user->nip_nisn ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs bg-red-600 text-white px-2.5 py-1 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400 italic">Akun Aktif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
