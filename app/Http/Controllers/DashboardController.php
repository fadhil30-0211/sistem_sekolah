<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Course;
use App\Exports\TicketsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $totalUsers = User::count();
        $totalTiket = Ticket::count();
        $tiketBaru = Ticket::where('status', 'Menunggu')->count();
        $recentTickets = Ticket::latest()->take(5)->get();

        return view('dashboard.admin', compact('totalUsers', 'totalTiket', 'tiketBaru', 'recentTickets'));
    }

    public function kepalaIndex()
    {
        $stats = [
            'total_ppdb' => Ticket::where('type', 'PPDB')->count(),
            'total_surat' => Ticket::where('type', 'SRT')->count(),
            'total_pengaduan' => Ticket::where('type', 'ADU')->count(),
            'total_jtm' => Ticket::where('type', 'JTM')->count(),
        ];
        $recentTickets = Ticket::latest()->take(10)->get();

        return view('dashboard.kepala', compact('stats', 'recentTickets'));
    }

    // Dashboard Guru (Dilengkapi rekap materi dan tugas siswa)
    public function guruIndex()
    {
        $courses = Course::where('guru_id', auth()->id())->with(['assignments.submissions'])->latest()->get();
        return view('dashboard.guru', compact('courses'));
    }

    public function tuIndex()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('dashboard.tu', compact('tickets'));
    }

    public function updateTicketStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'catatan_petugas' => 'nullable|string',
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;

        $ticket->update([
            'status' => $request->status,
            'catatan_petugas' => $request->catatan_petugas,
        ]);

        // Catat ke Activity Log
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Pembaruan Status Tiket',
            'deskripsi' => "Petugas " . auth()->user()->name . " mengubah status tiket {$ticket->ticket_code} dari '{$oldStatus}' menjadi '{$request->status}'.",
        ]);

        return back()->with('success', "Status tiket {$ticket->ticket_code} berhasil diperbarui.");
    }

    public function exportExcel(Request $request)
    {
        $type = $request->get('type');
        $fileName = $type ? "Rekap_Layanan_{$type}.xlsx" : "Rekap_Semua_Tiket.xlsx";
        return Excel::download(new TicketsExport($type), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $type = $request->get('type');
        $query = Ticket::query();
        if ($type) {
            $query->where('type', $type);
        }
        $tickets = $query->latest()->get();

        $pdf = Pdf::loadView('dashboard.pdf_recap', compact('tickets', 'type'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Rekapitulasi_Layanan_Sekolah.pdf');
    }
}
