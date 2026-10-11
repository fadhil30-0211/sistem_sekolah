<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    /**
     * Pencarian Status Tiket via Widget
     */
    public function track(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string|trim',
        ]);

        $ticket = Ticket::where('ticket_code', strtoupper($request->ticket_code))->first();

        if (!$ticket) {
            return back()->with('error', 'Kode tiket tidak ditemukan. Silakan periksa kembali.');
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Cetak Resi Ukuran A5 (Tampilan Cetak / PDF)
     */
    public function downloadReceipt($ticket_code)
    {
        $ticket = Ticket::where('ticket_code', $ticket_code)->firstOrFail();

        // Generate QR Code SVG berbasis URL Lacak
        $qrCode = QrCode::size(120)->generate(route('ticket.track', ['ticket_code' => $ticket->ticket_code]));

        $pdf = Pdf::loadView('tickets.pdf_receipt', compact('ticket', 'qrCode'))
            ->setPaper('a5', 'landscape');

        return $pdf->stream("Resi-{$ticket->ticket_code}.pdf");
    }
}
