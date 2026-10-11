@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 my-8">
    <h2 class="text-2xl font-bold text-navy mb-4">Tambah Pengguna Baru</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <input type="password" name="password" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role / Hak Akses</label>
            <select name="role" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
                <option value="super_admin">Super Admin / IT</option>
                <option value="kepala_sekolah">Kepala Sekolah</option>
                <option value="guru">Guru</option>
                <option value="staf_tu">Staf TU / Operator</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">NIP / NISN (Opsional)</label>
            <input type="text" name="nip_nisn" class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
        </div>
        <button type="submit" class="w-full bg-emerald text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition">
            Simpan Pengguna
        </button>
    </form>
</div>
@endsection
