@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-navy">Dashboard Pengajar (Guru)</h2>
            <p class="text-xs text-gray-500">Kelola materi pelajaran, buat tugas, dan periksa pengumpulan tugas siswa.</p>
        </div>
        <span class="bg-emerald/10 text-emerald text-xs font-semibold px-3 py-1.5 rounded-lg">
            {{ auth()->user()->name }}
        </span>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 border border-green-300 text-green-800 text-xs rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Form Tambah Materi Pelajaran -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            <h3 class="text-lg font-bold text-navy mb-4">Tambah Materi Pelajaran Baru</h3>
            <form action="{{ route('guru.lms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                    <input type="text" name="mata_pelajaran" required class="w-full text-xs rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kelas (Contoh: XI IPA 1)</label>
                    <input type="text" name="kelas" required class="w-full text-xs rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Judul Materi</label>
                    <input type="text" name="judul_materi" required class="w-full text-xs rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Deskripsi / Penjelasan</label>
                    <textarea name="deskripsi" rows="2" class="w-full text-xs rounded-lg border-gray-300"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">File Berkas Materi (PDF/Docx/PPTx)</label>
                    <input type="file" name="file_materi" class="w-full text-xs text-gray-500">
                </div>
                <button type="submit" class="w-full bg-emerald text-white py-2 rounded-lg text-xs font-semibold hover:bg-green-700 transition">
                    Publikasikan Materi
                </button>
            </form>
        </div>

        <!-- Form Tambah Tugas Siswa -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            <h3 class="text-lg font-bold text-navy mb-4">Buat Tugas Baru</h3>
            <form action="{{ route('guru.assignment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Pilih Materi / Mata Pelajaran Terkait</label>
                    <select name="course_id" required class="w-full text-xs rounded-lg border-gray-300">
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->mata_pelajaran }} ({{ $c->kelas }}) - {{ $c->judul_materi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Judul Tugas</label>
                    <input type="text" name="judul_tugas" required class="w-full text-xs rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Instruksi Pengerjaan</label>
                    <textarea name="instruksi" rows="2" required class="w-full text-xs rounded-lg border-gray-300"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Tenggat Waktu (Deadline)</label>
                    <input type="datetime-local" name="tenggat_waktu" required class="w-full text-xs rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">File Lampiran Tugas (Opsional)</label>
                    <input type="file" name="file_tugas" class="w-full text-xs text-gray-500">
                </div>
                <button type="submit" class="w-full bg-navy text-white py-2 rounded-lg text-xs font-semibold hover:bg-slate-800 transition">
                    Publikasikan Tugas
                </button>
            </form>
        </div>

    </div>

    <!-- Rekap Tugas & Penilaian Jawaban Siswa -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
        <h3 class="text-lg font-bold text-navy mb-4">Daftar Pengumpulan Tugas oleh Siswa</h3>
        <div class="space-y-4">
            @forelse($courses as $course)
                @foreach($course->assignments as $assignment)
                    <div class="border rounded-xl p-4 bg-offwhite">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-bold text-navy text-sm">{{ $assignment->judul_tugas }} <span class="text-xs font-normal text-gray-500">({{ $course->mata_pelajaran }} - {{ $course->kelas }})</span></h4>
                            <span class="text-xs bg-gold/20 text-navy px-2 py-0.5 rounded font-semibold">Tenggat: {{ date('d/m/Y H:i', strtotime($assignment->tenggat_waktu)) }}</span>
                        </div>

                        @if($assignment->submissions->count() > 0)
                            <div class="mt-3 overflow-x-auto">
                                <table class="w-full text-xs text-left text-gray-600 bg-white rounded-lg border">
                                    <thead class="bg-gray-100 text-navy uppercase font-semibold">
                                        <tr>
                                            <th class="px-3 py-2">Nama Siswa</th>
                                            <th class="px-3 py-2">Kelas</th>
                                            <th class="px-3 py-2">Waktu Kirim</th>
                                            <th class="px-3 py-2">File Jawaban</th>
                                            <th class="px-3 py-2">Nilai & Catatan</th>
                                            <th class="px-3 py-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignment->submissions as $sub)
                                            <tr class="border-t">
                                                <td class="px-3 py-2 font-medium text-navy">{{ $sub->nama_siswa }}</td>
                                                <td class="px-3 py-2">{{ $sub->kelas_siswa }}</td>
                                                <td class="px-3 py-2">{{ $sub->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="px-3 py-2">
                                                    <a href="{{ asset('storage/' . $sub->file_jawaban) }}" target="_blank" class="text-emerald font-semibold hover:underline">
                                                        📥 Download
                                                    </a>
                                                </td>
                                                <td class="px-3 py-2" colspan="2">
                                                    <form action="{{ route('guru.submission.grade', $sub->id) }}" method="POST" class="flex gap-2 items-center">
                                                        @csrf
                                                        <input type="number" name="nilai" value="{{ $sub->nilai }}" placeholder="Nilai (0-100)" min="0" max="100" class="w-24 text-xs rounded border-gray-300 p-1.5" required>
                                                        <input type="text" name="catatan_guru" value="{{ $sub->catatan_guru }}" placeholder="Catatan guru..." class="w-48 text-xs rounded border-gray-300 p-1.5">
                                                        <button type="submit" class="bg-navy text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-slate-800 transition">
                                                            Simpan
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-xs text-gray-400 italic mt-2">Belum ada siswa yang mengumpulkan tugas ini.</p>
                        @endif
                    </div>
                @endforeach
            @empty
                <p class="text-xs text-gray-500 text-center py-4">Belum ada materi atau tugas yang Anda buat.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
