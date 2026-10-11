<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Layanan SMAN Okura</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans p-8">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-6 border-b pb-4">
            <h1 class="text-xl font-bold text-slate-900">PEMERINTAH KOTA PEKANBARU</h1>
            <h2 class="text-lg font-bold text-slate-800">SMA NEGERI OKURA</h2>
            <p class="text-xs text-gray-500">Jl. Raja Panjang Okura, Rumbai Timur, Pekanbaru | Laporan Rekapitulasi Layanan Publik</p>
        </div>

        <div class="flex justify-between items-center mb-4 text-xs">
            <span class="font-semibold text-gray-700">Tanggal Cetak: {{ date('d F Y') }}</span>
            <button onclick="window.print()" class="no-print bg-slate-900 text-white px-4 py-2 rounded-lg font-semibold shadow">🖨️ Cetak Dokumen</button>
        </div>

        <table class="w-full text-left text-xs border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border border-gray-300 p-2.5">No</th>
                    <th class="border border-gray-300 p-2.5">Kode Resi</th>
                    <th class="border border-gray-300 p-2.5">Jenis</th>
                    <th class="border border-gray-300 p-2.5">Nama Pemohon</th>
                    <th class="border border-gray-300 p-2.5">Kontak</th>
                    <th class="border border-gray-300 p-2.5">Status</th>
                    <th class="border border-gray-300 p-2.5">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $index => $t)
                    <tr>
                        <td class="border border-gray-300 p-2.5 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 p-2.5 font-mono font-semibold">{{ $t->tracking_code }}</td>
                        <td class="border border-gray-300 p-2.5 font-bold">{{ $t->type }}</td>
                        <td class="border border-gray-300 p-2.5">{{ $t->name }}</td>
                        <td class="border border-gray-300 p-2.5">{{ $t->phone }}</td>
                        <td class="border border-gray-300 p-2.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                {{ $t->status == 'Pending' ? 'bg-amber-100 text-amber-800' : ($t->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800') }}">
                                {{ $t->status }}
                            </span>
                        </td>
                        <td class="border border-gray-300 p-2.5">{{ $t->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 p-4 text-center text-gray-500 italic">Belum ada data tiket layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-12 flex justify-end text-xs">
            <div class="text-center">
                <p class="mb-16">Pekanbaru, {{ date('d F Y') }}</p>
                <p class="font-bold underline">Kepala Tata Usaha SMAN Okura</p>
            </div>
        </div>
    </div>
</body>
</html>
