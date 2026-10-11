@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-navy">LMS Light - SMAN Okura</h2>
        <p class="text-sm text-gray-500">Akses materi pelajaran, kumpulkan tugas, dan lihat hasil penilaian guru secara online.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 text-xs rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded bg-emerald/10 text-emerald uppercase">{{ $course->mata_pelajaran }}</span>
                        <span class="text-xs font-bold text-gray-500">Kelas: {{ $course->kelas }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-1">{{ $course->judul_materi }}</h3>
                    <p class="text-xs text-gray-600 mb-4">{{ $course->deskripsi }}</p>

                    @if($course->file_materi)
                        <a href="{{ asset('storage/' . $course->file_materi) }}" target="_blank" class="text-xs text-emerald font-semibold hover:underline block mb-4">
                            📄 Download Berkas Materi →
                        </a>
                    @endif

                    <!-- Daftar Tugas dalam Mata Pelajaran Ini -->
                    @if($course->assignments->count() > 0)
                        <div class="border-t pt-3 mt-3">
                            <h4 class="text-xs font-bold text-navy uppercase mb-2">Tugas Terkait:</h4>
                            @foreach($course->assignments as $assignment)
                                <div class="bg-offwhite p-3 rounded-xl mb-3 border text-xs">
                                    <p class="font-bold text-navy">{{ $assignment->judul_tugas }}</p>
                                    <p class="text-gray-500 mt-1 mb-2">Tenggat: {{ date('d/m/Y H:i', strtotime($assignment->tenggat_waktu)) }}</p>

                                    <!-- Form Upload Jawaban Siswa -->
                                    <form action="{{ route('lms.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                                        @csrf
                                        <input type="text" name="nama_siswa" placeholder="Nama Lengkap Anda" required class="w-full text-xs rounded-lg border-gray-300">
                                        <input type="text" name="kelas_siswa" placeholder="Kelas (contoh: XI IPA 1)" required class="w-full text-xs rounded-lg border-gray-300">
                                        <input type="file" name="file_jawaban" required class="w-full text-xs text-gray-500">
                                        <button type="submit" class="w-full bg-navy text-white py-1.5 rounded-lg text-xs font-semibold hover:bg-slate-800 transition">
                                            Kirim Jawaban Tugas
                                        </button>
                                    </form>

                                    <!-- Riwayat Pengumpulan Jawaban & Nilai -->
                                    @if($assignment->submissions->count() > 0)
                                        <div class="mt-3 pt-2 border-t border-gray-200">
                                            <p class="text-[11px] font-bold text-gray-600 mb-1">Riwayat Pengumpulan:</p>
                                            @foreach($assignment->submissions as $sub)
                                                <div class="bg-white p-2 rounded-lg border mb-1 flex justify-between items-center text-[11px]">
                                                    <div>
                                                        <span class="font-semibold text-navy">{{ $sub->nama_siswa }}</span>
                                                        <span class="text-gray-400">({{ $sub->kelas_siswa }})</span>
                                                    </div>
                                                    <div>
                                                        @if(!is_null($sub->nilai))
                                                            <span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded">
                                                                Nilai: {{ $sub->nilai }}
                                                            </span>
                                                        @else
                                                            <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-0.5 rounded">
                                                                Belum Dinilai
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($sub->catatan_guru)
                                                    <p class="text-[10px] text-gray-500 italic px-1">
                                                        💬 Feedback Guru: "{{ $sub->catatan_guru }}"
                                                    </p>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-4 pt-3 border-t text-[11px] text-gray-400">
                    Pengajar: {{ $course->guru->name ?? 'Guru SMAN Okura' }}
                </div>
            </div>
        @empty
            <p class="text-xs text-gray-500 col-span-3 text-center py-8">Belum ada materi pelajaran yang diunggah.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $courses->links() }}
    </div>
</div>
@endsection
