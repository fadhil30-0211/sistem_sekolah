<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::create([
            'ticket_code' => Ticket::generateTicketCode('PPDB'),
            'type' => 'PPDB',
            'nama_pemohon' => 'Randi Pratama',
            'kontak_pemohon' => '081299887766',
            'judul_layanan' => 'Pendaftaran Siswa Baru - Jurnal Umum',
            'deskripsi' => 'Pengajuan berkas pendaftaran PPDB jalur zonasi.',
            'status' => 'Diproses',
        ]);

        Ticket::create([
            'ticket_code' => Ticket::generateTicketCode('SRT'),
            'type' => 'SRT',
            'nama_pemohon' => 'Siti Rahma',
            'kontak_pemohon' => 'siti@gmail.com',
            'judul_layanan' => 'Permohonan Surat Keterangan Aktif Sekolah',
            'deskripsi' => 'Dibutuhkan untuk kelengkapan beasiswa daerah.',
            'status' => 'Menunggu',
        ]);
    }
}
