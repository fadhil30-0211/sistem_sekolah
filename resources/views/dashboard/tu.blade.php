@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-navy">Dashboard Operator TU</h2>
            <p class="text-xs text-gray-500">Kelola dan verifikasi tiket pengajuan layanan dari masyarakat & siswa.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('dashboard.export.excel') }}" class="bg-emerald text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-green-700 transition">
                📥 Ekspor Excel
            </a>
            <a href="{{ route('dashboard.export.pdf') }}" target="_blank" class="bg-navy text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-slate-800 transition">
                🖨️ Ekspor PDF
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 text-xs rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-navy uppercase bg-offwhite border-b">
                <tr>
                    <th class="px-4 py-3">Kode Tiket</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Pemohon</th>
                    <th class="px-4 py-3">Judul Layanan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi / Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-bold text-navy">{{ $ticket->ticket_code }}</td>
                        <td class="px-4 py-3"><span class="px-2 py-0.5 text-xs bg-gold/20 text-navy font-semibold rounded">{{ $ticket->type }}</span></td>
                        <td class="px-4 py-3">{{ $ticket->is_anonymous ? 'Anonim' : $ticket->nama_pemohon }}</td>
                        <td class="px-4 py-3">{{ $ticket->judul_layanan }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs font-semibold rounded
                                {{ $ticket->status == 'Selesai' ? 'bg-green-100 text-green-800' : ($ticket->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('tu.ticket.update', $ticket->id) }}" method="POST" class="flex items-center gap-1">
                                @csrf
                                @method('PUT')
                                <select name="status" class="text-xs border-gray-300 rounded py-1 px-2 focus:ring-emerald">
                                    <option value="Menunggu" {{ $ticket->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Diproses" {{ $ticket->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ $ticket->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditolak" {{ $ticket->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <button type="submit" class="bg-emerald text-white text-xs px-2.5 py-1 rounded hover:bg-green-700">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-xs text-gray-500">Belum ada tiket pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
