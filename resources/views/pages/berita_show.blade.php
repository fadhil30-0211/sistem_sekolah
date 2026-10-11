@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 my-8">
    <span class="text-xs font-semibold px-2.5 py-1 rounded bg-emerald/10 text-emerald uppercase">
        {{ $post->kategori }}
    </span>
    <h1 class="text-3xl font-bold text-navy mt-2 mb-3">{{ $post->judul }}</h1>
    <p class="text-xs text-gray-500 mb-6">Dipublikasikan oleh <span class="font-semibold text-navy">{{ $post->author->name ?? 'Admin' }}</span> pada {{ $post->created_at->translatedFormat('d F Y, H:i') }} WIB</p>

    <div class="prose max-w-none text-navy text-sm leading-relaxed space-y-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    <div class="mt-8 pt-4 border-t">
        <a href="{{ route('berita.index') }}" class="text-xs font-semibold bg-gray-200 text-navy px-4 py-2 rounded-lg hover:bg-gray-300 transition">
            ← Kembali ke Berita
        </a>
    </div>
</div>
@endsection
