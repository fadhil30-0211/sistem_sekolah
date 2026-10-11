@extends('layouts.app')

@section('content')
<!-- Hero Carousel (Flowbite) -->
<div id="default-carousel" class="relative w-full mb-8 rounded-2xl overflow-hidden shadow-xl" data-carousel="slide">
    <div class="relative h-64 overflow-hidden rounded-2xl md:h-96">
        @forelse($slides as $index => $slide)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('storage/' . $slide->gambar) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="Slide">
                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent flex items-end p-8">
                    <div class="text-white">
                        <h2 class="text-2xl md:text-4xl font-bold mb-2">{{ $slide->judul }}</h2>
                        <p class="text-sm md:text-base text-gray-200">{{ $slide->subjudul }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="duration-700 ease-in-out bg-navy flex items-center justify-center h-full text-white">
                <div class="text-center p-6">
                    <h2 class="text-3xl font-bold text-gold">Selamat Datang di SMAN Okura</h2>
                    <p class="mt-2 text-gray-300">Unggul dalam Prestasi, Berkarakter, dan Berbudaya Lingkungan</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

    <!-- Widget Lacak Status (Bento Item 1) -->
    <div class="md:col-span-2">
        @if(view()->exists('components.track-widget'))
            @include('components.track-widget')
        @else
            <!-- Card Lacak Resi Publik jika komponen belum ada -->
            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 h-full flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald/10 text-emerald uppercase tracking-wider">Fitur Publik</span>
                    <h3 class="text-xl font-bold text-navy mt-2">Lacak Status Layanan</h3>
                    <p class="text-xs text-gray-500 mt-1">Masukkan nomor resi tiket layanan Anda (PPDB, Surat, Pengaduan, atau Jadwal Temu) untuk memantau prosesnya.</p>
                </div>
                <form action="{{ route('services.search') }}" method="POST" class="mt-4 flex gap-2">
                    @csrf
                    <input type="text" name="tracking_code" placeholder="Contoh: SRT-20261011-XXXX" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5 font-mono uppercase">
                    <button type="submit" class="bg-navy text-white px-5 py-2.5 rounded-xl text-xs font-semibold hover:bg-slate-800 transition shadow">Cek</button>
                </form>
            </div>
        @endif
    </div>

    <!-- Quick Access Layanan Publik (Bento Item 2) -->
    <div class="bg-emerald text-white p-6 rounded-2xl shadow-md flex flex-col justify-between">
        <div>
            <span class="bg-gold text-navy text-[10px] font-bold px-2 py-0.5 rounded uppercase">Layanan Digital</span>
            <h3 class="text-xl font-bold mt-2">Pelayanan Publik SMAN Okura</h3>
            <p class="text-xs text-gray-100 mt-1">Akses cepat pengajuan formulir secara mandiri dan online.</p>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
            <a href="{{ route('services.ppdb') }}" class="bg-white text-emerald font-bold text-center py-2.5 px-2 rounded-xl hover:bg-gray-100 transition shadow-sm">
                🎓 PPDB
            </a>
            <a href="{{ route('services.surat') }}" class="bg-navy text-white font-bold text-center py-2.5 px-2 rounded-xl hover:bg-slate-800 transition shadow-sm">
                📄 Surat TU
            </a>
            <a href="{{ route('services.pengaduan') }}" class="bg-rose-700 text-white font-bold text-center py-2.5 px-2 rounded-xl hover:bg-rose-800 transition shadow-sm">
                💬 Pengaduan
            </a>
            <a href="{{ route('services.jtm') }}" class="bg-amber-600 text-white font-bold text-center py-2.5 px-2 rounded-xl hover:bg-amber-700 transition shadow-sm">
                🤝 Jadwal Temu
            </a>
        </div>
    </div>

    <!-- Sambutan Kepala Sekolah (Bento Item 3) -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 md:col-span-1">
        <div class="flex items-center gap-4 mb-3">
            <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                <div class="w-full h-full bg-navy flex items-center justify-center text-gold font-bold">KS</div>
            </div>
            <div>
                <h4 class="font-bold text-navy text-sm">Dr. H. Ahmad Kepala, M.Pd.</h4>
                <p class="text-xs text-gray-500">Kepala SMAN Okura</p>
            </div>
        </div>
        <p class="text-xs text-gray-600 italic leading-relaxed">"Selamat datang di portal resmi digital SMA Negeri Okura. Kami berkomitmen memberikan layanan pendidikan digital yang transparan, akuntabel, dan ramah masyarakat."</p>
    </div>

    <!-- Berita Terkini (Bento Item 4) -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 md:col-span-2">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-navy text-lg">Berita & Pengumuman Terbaru</h3>
            <a href="{{ route('berita.index') }}" class="text-xs font-semibold text-emerald hover:underline">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($posts as $post)
                <div class="border rounded-xl p-3 flex flex-col justify-between hover:border-emerald transition">
                    <div>
                        <span class="text-[10px] font-semibold bg-gray-100 text-gray-700 px-2 py-0.5 rounded">
                            {{ $post->kategori ?? $post->category ?? 'Umum' }}
                        </span>
                        <h4 class="font-semibold text-navy text-sm mt-1 line-clamp-2">
                            {{ $post->title ?? $post->judul }}
                        </h4>
                    </div>
                    <a href="{{ route('berita.show', $post->slug) }}" class="text-xs text-emerald font-medium mt-3 inline-block">Baca Selengkapnya →</a>
                </div>
            @empty
                <p class="text-xs text-gray-500 col-span-2 italic">Belum ada berita dipublikasikan.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
