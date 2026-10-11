@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header sambutan -->
    <div class="bg-gradient-to-r from-[#0F172A] to-[#1E293B] p-6 rounded-3xl shadow-lg text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-amber-500/20 text-amber-400 uppercase tracking-wider">Super Admin / IT Panel</span>
            <h2 class="text-3xl font-bold mt-2">Selamat Datang, {{ auth()->user()->name }}</h2>
            <p class="text-xs text-gray-300 mt-1">Pusat kendali utama sistem informasi dan portal resmi SMAN Okura.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.users.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition shadow-md">
                👥 Kelola Pengguna
            </a>
            <a href="{{ route('home') }}" target="_blank" class="bg-white/10 hover:bg-white/20 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition">
                🌐 Lihat Portal Publik
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-2xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bento Grid Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Kartu 1: Total Pengguna -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                👥
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Pengguna</p>
                <h3 class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalUsers ?? 0 }}</h3>
                <span class="text-[10px] text-emerald-600 font-semibold">Aktif di sistem</span>
            </div>
        </div>

        <!-- Kartu 2: Total Tiket -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                🎫
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Layanan / Tiket</p>
                <h3 class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalTiket ?? 0 }}</h3>
                <span class="text-[10px] text-amber-600 font-semibold">Semua kategori</span>
            </div>
        </div>

        <!-- Kartu 3: Tiket Baru -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">
                ⏳
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tiket Menunggu</p>
                <h3 class="text-2xl font-black text-slate-800 mt-0.5">{{ $tiketBaru ?? 0 }}</h3>
                <span class="text-[10px] text-rose-600 font-semibold">Perlu tindakan TU</span>
            </div>
        </div>

        <!-- Kartu 4: Status Sistem -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100 flex items-center gap-4 hover:shadow-lg transition">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                ⚡
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status Server</p>
                <h3 class="text-lg font-black text-emerald-600 mt-0.5">Normal (Online)</h3>
                <span class="text-[10px] text-gray-400">Laravel 13 / PHP 8.4</span>
            </div>
        </div>
    </div>

    <!-- Grid Bawah: Tiket Terbaru & Log Aktivitas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Tabel Tiket Terbaru -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-slate-800">Tiket Layanan Terbaru</h3>
                <span class="text-xs text-gray-400">5 entri terakhir</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left text-gray-600">
                    <thead class="bg-gray-50 text-slate-700 uppercase font-semibold">
                        <tr>
                            <th class="px-3 py-2.5 rounded-l-xl">Kode</th>
                            <th class="px-3 py-2.5">Pemohon</th>
                            <th class="px-3 py-2.5">Layanan</th>
                            <th class="px-3 py-2.5 rounded-r-xl">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentTickets ?? [] as $t)
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-3 py-3 font-bold text-slate-800">{{ $t->ticket_code }}</td>
                                <td class="px-3 py-3">{{ $t->name }}</td>
                                <td class="px-3 py-3"><span class="px-2 py-0.5 bg-slate-100 font-semibold rounded text-[11px]">{{ $t->type }}</span></td>
                                <td class="px-3 py-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold
                                        {{ $t->status == 'Selesai' ? 'bg-emerald-100 text-emerald-700' : ($t->status == 'Diproses' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                        {{ $t->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-400 italic">Belum ada data tiket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Log Aktivitas Sistem -->
        <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-slate-800">Riwayat Log Aktivitas Sistem</h3>
                <span class="text-xs text-gray-400">Audit Trail</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left text-gray-600">
                    <thead class="bg-gray-50 text-slate-700 uppercase font-semibold">
                        <tr>
                            <th class="px-3 py-2.5 rounded-l-xl">Waktu</th>
                            <th class="px-3 py-2.5">Pengguna</th>
                            <th class="px-3 py-2.5 rounded-r-xl">Aktivitas & Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $logs = \App\Models\ActivityLog::with('user')->latest()->take(5)->get();
                        @endphp
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-3 py-3 text-gray-400 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-3 font-semibold text-slate-800 whitespace-nowrap">{{ $log->user->name ?? 'Sistem' }}</td>
                                <td class="px-3 py-3">
                                    <span class="font-semibold text-emerald-600 block mb-0.5">{{ $log->aktivitas }}</span>
                                    <span class="text-gray-500 text-[11px]">{{ $log->deskripsi }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-400 italic">Belum ada aktivitas tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
