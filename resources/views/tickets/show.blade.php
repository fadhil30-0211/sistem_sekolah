@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100 my-8">
    <div class="flex justify-between items-start border-b pb-4 mb-6">
        <div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-gold/20 text-navy uppercase">
                {{ $ticket->type }}
            </span>
            <h2 class="text-2xl font-bold text-navy mt-1">{{ $ticket->ticket_code }}</h2>
            <p class="text-xs text-gray-500">Diajukan pada: {{ $ticket->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
        </div>
        <div>
            @php
                $statusColors = [
                    'Menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                    'Diproses' => 'bg-blue-100 text-blue-800 border-blue-300',
                    'Selesai'  => 'bg-green-100 text-green-800 border-green-300',
                    'Ditolak'  => 'bg-red-100 text-red-800 border-red-300',
                ];
            @endphp
            <span class="px-3 py-1 text-sm font-semibold border rounded-full {{ $statusColors[$ticket->status] }}">
                {{ $ticket->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
        <div>
            <p class="text-gray-500 text-xs">Nama Pemohon</p>
            <p class="font-medium text-navy">{{ $ticket->is_anonymous ? 'Anonim' : $ticket->nama_pemohon }}</p>
        </div>
        <div>
            <p class="text-gray-500 text-xs">Judul Layanan / Keperluan</p>
            <p class="font-medium text-navy">{{ $ticket->judul_layanan }}</p>
        </div>
        <div class="col-span-2">
            <p class="text-gray-500 text-xs">Deskripsi / Detail</p>
            <p class="text-navy bg-offwhite p-3 rounded-lg border mt-1">{{ $ticket->deskripsi ?? 'Tidak ada rincian tambahan.' }}</p>
        </div>
        @if($ticket->catatan_petugas)
            <div class="col-span-2 bg-emerald/10 p-3 rounded-lg border border-emerald/20">
                <p class="text-emerald font-semibold text-xs">Catatan dari Petugas Sekolah:</p>
                <p class="text-navy text-sm mt-1">{{ $ticket->catatan_petugas }}</p>
            </div>
        @endif
    </div>

    <div class="flex flex-wrap gap-3 pt-4 border-t">
        <a href="{{ route('ticket.receipt', $ticket->ticket_code) }}" target="_blank" class="bg-emerald text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak / Download Resi (PDF A5)
        </a>
        <a href="{{ route('home') }}" class="bg-gray-200 text-navy text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-300 transition">
            Kembali
        </a>
    </div>
</div>
@endsection
