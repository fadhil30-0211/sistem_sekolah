@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 my-8">
    <div class="mb-6 border-b pb-4">
        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-blue-100 text-blue-800 uppercase">Layanan JTM</span>
        <h2 class="text-2xl font-bold text-navy mt-1">Form Jadwal Temu & Konsultasi</h2>
        <p class="text-xs text-gray-500">Ajukan sesi konsultasi tatap muka dengan pihak sekolah.</p>
    </div>

    <form action="{{ route('services.jtm.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemohon (Orang Tua / Siswa)</label>
                <input type="text" name="nama_pemohon" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp / HP</label>
                <input type="text" name="kontak_pemohon" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pihak Sekolah yang Ingin Ditemui</label>
            <select name="tujuan_temu" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
                <option value="Wali Kelas">Wali Kelas</option>
                <option value="Guru Bimbingan Konseling (BK)">Guru Bimbingan Konseling (BK)</option>
                <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
                <option value="Kepala Sekolah / Wakil Kepala">Kepala Sekolah / Wakil Kepala</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rencana Tanggal Temu</label>
                <input type="date" name="tanggal_temu" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rencana Waktu / Jam</label>
                <input type="time" name="waktu_temu" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Maksud & Perihal Konsultasi</label>
            <textarea name="deskripsi" rows="3" required placeholder="Jelaskan secara singkat topik konsultasi..." class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald"></textarea>
        </div>

        <button type="submit" class="w-full bg-emerald text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition">
            Ajukan Jadwal Temu
        </button>
    </form>
</div>
@endsection
