<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $type;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function collection()
    {
        if ($this->type) {
            return Ticket::where('type', $this->type)->latest()->get();
        }
        return Ticket::latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode Tiket',
            'Jenis Layanan',
            'Nama Pemohon',
            'Kontak',
            'Judul / Perihal',
            'Status',
            'Tanggal Tanggal Ajuan',
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->ticket_code,
            $ticket->type,
            $ticket->is_anonymous ? 'Anonim' : $ticket->nama_pemohon,
            $ticket->kontak_pemohon,
            $ticket->judul_layanan,
            $ticket->status,
            $ticket->created_at->format('d/m/Y H:i'),
        ];
    }
}
