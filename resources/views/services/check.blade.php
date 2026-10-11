@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100">
        <div class="text-center mb-8">
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald/10 text-emerald uppercase tracking-wider">Lacak Layanan</span>
            <h2 class="text-2xl font-bold text-navy mt-2">Cek Status Pengajuan Tiket</h2>
            <p class="text-xs text-gray-500 mt-1">Masukkan nomor resi unik yang Anda dapatkan saat mengirimkan formulir layanan.</p>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-2xl text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('services.search') }}" method="POST" class="flex gap-2 mb-8">
            @csrf
            <input type="text" name="tracking_code" value="{{ isset($service) ? $service->tracking_code : old('tracking_code') }}" placeholder="Contoh: SRT-20261011-XXXX" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-3 uppercase font-mono">
            <button type="submit" class="bg-navy text-white px-6 py-3 rounded-xl text-xs font-semibold hover:bg-slate-800 transition whitespace-nowrap shadow-md">
                Cek Status
            </button>
        </form>

        @isset($service)
            <div class="bg-offwhite p-6 rounded-2xl border border-gray-200 space-y-4 text-xs">
                <div class="flex justify-between items-center border-b pb-3">
                    <div>
                        <span class="text-gray-400 block text-[10px]">KODE RESI TIKET</span>
                        <span class="font-mono font-bold text-navy text-sm">{{ $service->tracking_code }}</span>
                    </div>
                    <div>
                        @if($service->status == 'Pending')
                            <span class="bg-amber-100 text-amber-800 font-bold px-3 py-1 rounded-full text-[11px]">Menunggu Verifikasi</span>
                        @elseif($service->status == 'Diproses')
                            <span class="bg-blue-100 text-blue-800 font-bold px-3 py-1 rounded-full text-[11px]">Sedang Diproses Staf</span>
                        @else
                            <span class="bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full text-[11px]">Selesai / Terverifikasi</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-gray-400 block text-[10px]">JENIS LAYANAN</span>
                        <span class="font-bold text-navy">{{ $service->type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">TANGGAL PENGAJUAN</span>
                        <span class="font-medium text-gray-700">{{ $service->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">NAMA PEMOHON</span>
                        <span class="font-medium text-gray-700">{{ $service->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">KONTAK (HP/WA)</span>
                        <span class="font-medium text-gray-700">{{ $service->phone }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-gray-400 block text-[10px] mb-1">KETERANGAN / KEPERLUAN</span>
                    <p class="bg-white p-3 rounded-xl border text-gray-600">{{ $service->description }}</p>
                </div>

                @if($service->admin_note)
                    <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-200">
                        <span class="text-emerald-800 font-bold block mb-1">💬 Catatan / Respon Petugas TU:</span>
                        <p class="text-emerald-900">{{ $service->admin_note }}</p>
                    </div>
                @endif
            </div>
        @endisset
    </div>
</div>
@endsection
