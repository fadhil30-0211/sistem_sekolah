<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'type',
        'nama_pemohon',
        'kontak_pemohon',
        'judul_layanan',
        'deskripsi',
        'status',
        'catatan_petugas',
        'is_anonymous',
    ];

    /**
     * Generator Otomatis Kode Tiket Universal: PREFIKS-YYYYMMDD-XXX
     */
    public static function generateTicketCode(string $prefix): string
    {
        $prefix = strtoupper($prefix);
        $dateStr = date('Ymd');

        // Cari nomor urut terakhir pada hari yang sama dan prefiks yang sama
        $lastTicket = self::where('ticket_code', 'LIKE', "{$prefix}-{$dateStr}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastSequence = (int) substr($lastTicket->ticket_code, -3);
            $newSequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newSequence = '001';
        }

        return "{$prefix}-{$dateStr}-{$newSequence}";
    }

    public function ppdbDetail()
    {
        return $this->hasOne(PpdbRegistration::class);
    }

    public function suratDetail()
    {
        return $this->hasOne(SuratRequest::class);
    }

    public function jadwalTemuDetail()
    {
        return $this->hasOne(JadwalTemuRequest::class);
    }
}
