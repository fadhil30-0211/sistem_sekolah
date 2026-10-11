<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
    <div class="flex items-center gap-3 mb-4">
        <div class="p-3 bg-emerald/10 text-emerald rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-navy">Lacak Status Layanan</h3>
            <p class="text-xs text-gray-500">Masukkan kode tiket PPDB, Surat, Pengaduan, atau Jadwal Temu</p>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-3 p-3 bg-red-100 text-red-700 text-xs rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('ticket.track') }}" method="GET" class="flex gap-2">
        <input
            type="text"
            name="ticket_code"
            placeholder="Contoh: PPDB-20261011-001"
            required
            class="flex-1 rounded-lg border-gray-300 text-sm focus:border-emerald focus:ring-emerald uppercase"
        >
        <button type="submit" class="bg-navy text-white px-5 py-2 rounded-lg font-medium text-sm hover:bg-slate-800 transition">
            Cari Tiket
        </button>
    </form>
</div>
