@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100">
        <div class="mb-6 border-b pb-4">
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald/10 text-emerald uppercase tracking-wider">Layanan Digital</span>
            <h2 class="text-2xl font-bold text-navy mt-2">Formulir PPDB Digital (SMAN Okura)</h2>
            <p class="text-xs text-gray-500 mt-1">Isi data calon peserta didik baru dengan benar. Setelah mengirimkan formulir, Anda akan mendapatkan kode resi dan QR Code untuk lacak status.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-2xl">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" name="type" value="PPDB">

            <div>
                <label class="block font-medium text-gray-700 mb-1">Nama Lengkap Calon Siswa <span class="text-rose-500">*</span></label>
                <input type="text" name="name" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">NIK / NISN <span class="text-rose-500">*</span></label>
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
                <label class="block font-medium text-gray-700 mb-1">Alamat Lengkap Tempat Tinggal <span class="text-rose-500">*</span></label>
                <textarea name="address" rows="3" required class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Keterangan / Sekolah Asal (SMP/MTs) <span class="text-rose-500">*</span></label>
                <textarea name="description" rows="2" required placeholder="Tuliskan nama sekolah asal dan jalur pendaftaran (Zonasi/Prestasi/Afirmasi)..." class="w-full text-xs rounded-xl border-gray-300 focus:ring-emerald focus:border-emerald p-2.5"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Unggah Lampiran Berkas (SKL / Ijazah / KK) - Max 2MB <span class="text-rose-500">*</span></label>
                <input type="file" name="attachment" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald/10 file:text-emerald hover:file:bg-emerald/20">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-navy text-white py-3 rounded-xl text-xs font-semibold hover:bg-slate-800 transition shadow-md">
                    Kirim Pendaftaran PPDB
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
