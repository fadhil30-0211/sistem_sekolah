@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-navy">Galeri Foto & Video SMAN Okura</h2>
        <p class="text-xs text-gray-500">Dokumentasi kegiatan sekolah, fasilitas, dan program KKN.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($mediaList as $media)
            <div class="bg-white rounded-2xl shadow-md border overflow-hidden">
                @if($media->type == 'image')
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="Galeri" class="w-full h-48 object-cover">
                @elseif($media->type == 'video_file')
                    <video controls class="w-full h-48 object-cover bg-black">
                        <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                @elseif($media->type == 'video_embed')
                    <div class="w-full h-48">
                        <iframe src="{{ $media->embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif
                <div class="p-4">
                    <p class="text-xs font-medium text-navy">{{ $media->caption ?? 'Dokumentasi SMAN Okura' }}</p>
                </div>
            </div>
        @empty
            <p class="text-xs text-gray-500 col-span-3 text-center py-8">Belum ada dokumentasi galeri yang diunggah.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $mediaList->links() }}
    </div>
</div>
@endsection
