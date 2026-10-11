<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Tiket - {{ $ticket->tracking_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <!-- Header Resi -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <div>
                <h1 class="font-bold text-lg text-slate-900">SMA NEGERI OKURA</h1>
                <p class="text-xs text-gray-500">Portal Layanan Administrasi Terpadu</p>
            </div>
            <div class="text-right">
                <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2.5 py-1 rounded-full uppercase">{{ $ticket->type }}</span>
            </div>
        </div>

        <!-- Detail Tiket -->
        <div class="text-center mb-6">
            <span class="text-xs text-gray-400 block">KODE RESI / TRACKING CODE</span>
            <h2 class="font-mono font-bold text-2xl text-slate-900 tracking-wider mt-1">{{ $ticket->tracking_code }}</h2>
            <p class="text-xs text-emerald-700 font-medium mt-1">Status: {{ $ticket->status }}</p>
        </div>

        <div class="space-y-3 text-xs border-t border-b py-4 mb-6">
            <div class="flex justify-between">
                <span class="text-gray-500">Tanggal Pengajuan:</span>
                <span class="font-medium text-gray-800">{{ $ticket->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Nama Pemohon:</span>
                <span class="font-medium text-gray-800">{{ $ticket->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Nomor Kontak (HP/WA):</span>
                <span class="font-medium text-gray-800">{{ $ticket->phone }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Email:</span>
                <span class="font-medium text-gray-800">{{ $ticket->email }}</span>
            </div>
        </div>

        <div class="mb-6 text-xs">
            <span class="text-gray-500 block mb-1">Keterangan / Keperluan:</span>
            <p class="bg-gray-50 p-3 rounded-xl border text-gray-700 leading-relaxed">{{ $ticket->description }}</p>
        </div>

        @if($ticket->admin_note)
            <div class="mb-6 text-xs bg-emerald-50 p-3 rounded-xl border border-emerald-200">
                <span class="font-bold text-emerald-800 block mb-1">Catatan Petugas TU:</span>
                <p class="text-emerald-900">{{ $ticket->admin_note }}</p>
            </div>
        @endif

        <!-- Footer / Tanda Tangan -->
        <div class="flex justify-between items-end mt-8 pt-6 border-t text-[11px] text-gray-500">
            <div>
                <p>Simpan resi ini sebagai bukti</p>
                <p>pengajuan layanan di SMAN Okura.</p>
            </div>
            <div class="text-center">
                <p class="mb-12">Petugas Pelayanan TU,</p>
                <p class="font-bold text-gray-800 underline">( Staf Administrasi )</p>
            </div>
        </div>

        <!-- Tombol Aksi Cetak -->
        <div class="mt-8 text-center no-print flex gap-3">
            <button onclick="window.print()" class="w-full bg-slate-900 text-white py-2.5 rounded-xl text-xs font-semibold hover:bg-slate-800 transition shadow">
                🖨️ Cetak / Simpan PDF
            </button>
            <a href="{{ route('services.check') }}" class="w-full bg-gray-200 text-gray-700 py-2.5 rounded-xl text-xs font-semibold hover:bg-gray-300 transition flex items-center justify-center">
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
