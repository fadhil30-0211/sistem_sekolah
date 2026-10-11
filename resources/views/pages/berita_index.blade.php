@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <div class="mb-8">
        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald/10 text-emerald uppercase tracking-wider">Informasi & Kegiatan</span>
        <h2 class="text-3xl font-bold text-navy mt-2">Berita & Pengumuman SMAN Okura</h2>
        <p class="text-sm text-gray-500 mt-1">Ikuti perkembangan terbaru, agenda kegiatan, dan pengumuman resmi sekolah.</p>
    </div>

    <!-- Grid Berita -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    @if(isset($post->image) && $post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title ?? $post->judul }}" class="w-full h-48 object-cover rounded-2xl mb-4">
                    @endif
                    <span class="text-[11px] text-gray-400 font-medium">{{ $post->created_at->format('d M Y') }}</span>

                    <!-- Mendukung nama kolom title/judul -->
                    <h3 class="text-lg font-bold text-navy mt-1 mb-2 leading-snug">
                        {{ $post->title ?? $post->judul ?? 'Tanpa Judul' }}
                    </h3>

                    <!-- Mendukung nama kolom content/isi/deskripsi -->
                    <p class="text-xs text-gray-600 line-clamp-3">
                        {{ Str::limit(strip_tags($post->content ?? $post->isi ?? $post->deskripsi ?? ''), 120) }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('berita.show', $post->slug) }}" class="text-xs font-semibold text-emerald hover:underline flex items-center gap-1">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-3xl border border-gray-100">
                <p class="text-sm text-gray-400 italic">Belum ada berita atau pengumuman yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <!-- Paging -->
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
