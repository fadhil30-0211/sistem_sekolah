@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <div class="mb-8">
        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald/10 text-emerald uppercase tracking-wider">Tentang Sekolah</span>
        <h2 class="text-3xl font-bold text-navy mt-2">Profil SMA Negeri Okura</h2>
        <p class="text-sm text-gray-500 mt-1">Mengenal lebih dekat sejarah, visi, misi, dan fasilitas yang ada di SMAN Okura.</p>
    </div>

    <!-- Informasi Profil -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 md:col-span-2 space-y-4 text-xs">
            <h3 class="text-lg font-bold text-navy">Sejarah Singkat</h3>
            <p class="text-gray-600 leading-relaxed">
                SMA Negeri Okura terletak di Kelurahan Tebing Tinggi Okura, Kecamatan Rumbai Timur, Kota Pekanbaru, Riau. Sekolah ini berkomitmen untuk mencerdaskan kehidupan bangsa melalui pendidikan yang berkualitas, berkarakter luhur, serta peduli terhadap kelestarian lingkungan sekitar.
            </p>

            <h3 class="text-lg font-bold text-navy pt-2">Visi & Misi</h3>
            <div class="space-y-2">
                <p class="font-bold text-emerald">Visi:</p>
                <p class="text-gray-600 italic bg-gray-50 p-3 rounded-xl border">"Unggul dalam Prestasi, Berkarakter, dan Berbudaya Lingkungan."</p>

                <p class="font-bold text-emerald pt-2">Misi:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 pl-2">
                    <li>Menyelenggarakan proses pembelajaran yang efektif dan berorientasi pada mutu.</li>
                    <li>Mengembangkan potensi peserta didik secara optimal di bidang akademik maupun non-akademik.</li>
                    <li>Membentuk kepribadian siswa yang berakhlak mulia dan berbudaya lokal.</li>
                    <li>Menciptakan lingkungan sekolah yang bersih, hijau, dan asri.</li>
                </ul>
            </div>
        </div>

        <!-- Kartu Kepala Sekolah & Kontak -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 text-center">
                <div class="w-20 h-20 bg-navy text-gold font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-3 shadow">
                    KS
                </div>
                <h4 class="font-bold text-navy text-sm">Dr. H. Ahmad Kepala, M.Pd.</h4>
                <p class="text-xs text-gray-500 mb-3">Kepala Sekolah SMAN Okura</p>
                <p class="text-[11px] text-gray-600 italic">"Pendidikan adalah investasi terbaik untuk masa depan bangsa."</p>
            </div>

            <div class="bg-navy text-white p-6 rounded-3xl shadow-md text-xs space-y-2">
                <h4 class="font-bold text-gold text-sm mb-2">Kontak Sekolah</h4>
                <p>📍 Jl. Raja Panjang Okura, Rumbai Timur, Pekanbaru</p>
                <p>📧 info@smanokura.sch.id</p>
                <p>📞 (0761) 1234567</p>
            </div>
        </div>
    </div>
</div>
@endsection
