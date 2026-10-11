@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100">
        <div class="mb-6 border-b pb-4">
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-amber-100 text-amber-800 uppercase tracking-wider">Layanan Kunjungan</span>
            <h2 class="text-2xl font-bold text-navy mt-2">Formulir Jadwal Temu (JTM)</h2>
            <p class="text-xs text-gray-500 mt-1">Ajukan permohonan jadwal pertemuan tatap muka dengan pihak sekolah, guru mata pelajaran, atau kepala sekolah.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-2xl">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" name="type" value="JTM">

            <div>
                <label class="block font-medium text-gray-700 mb-1">Nama Lengkap Tamu / Orang Tua / Wali <span class="text-rose-500">*</span></label>
                <input type="text" name="name" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nomor Identitas (KTP / SIM) <span class="text-rose-500">*</span></label>
                    <input type="text" name="identity_number" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nomor WhatsApp / HP <span class="text-rose-500">*</span></label>
                    <input type="text" name="phone" required placeholder="08xxxxxxxxxx" class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5">
                </div>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Alamat Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" required placeholder="contoh@gmail.com" class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5">
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Tujuan Pertemuan & Guru / Pihak yang Ingin Ditemui <span class="text-rose-500">*</span></label>
                <textarea name="description" rows="3" required placeholder="Tuliskan keperluan kunjungan serta nama guru atau staf yang ingin dituju beserta usulan waktu pertemuannya..." class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Unggah Dokumen Pendukung (Opsional) - Max 2MB</label>
                <input type="file" name="attachment" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald/10 file:text-emerald hover:file:bg-emerald/20">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-navy text-white py-3 rounded-xl text-xs font-semibold hover:bg-slate-800 transition shadow-md">
                    Ajukan Jadwal Temu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
