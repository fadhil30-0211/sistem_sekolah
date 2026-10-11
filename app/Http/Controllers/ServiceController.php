<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\PpdbRegistration;
use App\Models\SuratRequest;
use App\Models\JadwalTemuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    // Form Index Layanan
    public function index()
    {
        return view('services.index');
    }

    // Form PPDB
    public function formPpdb() { return view('services.ppdb'); }

    // Simpan PPDB
    public function storePpdb(Request $request)
    {
        $request->validate([
            'nama_pemohon'  => 'required|string|max:255',
            'kontak_pemohon'=> 'required|string|max:20',
            'nisn'          => 'required|string|max:10',
            'nik'           => 'required|string|max:16',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'asal_sekolah'  => 'required|string',
            'alamat_lengkap'=> 'required|string',
            'file_ijazah'   => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'file_kk'       => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        return DB::transaction(function () use ($request) {
            $ticket = Ticket::create([
                'ticket_code'    => Ticket::generateTicketCode('PPDB'),
                'type'           => 'PPDB',
                'nama_pemohon'   => $request->nama_pemohon,
                'kontak_pemohon' => $request->kontak_pemohon,
                'judul_layanan'  => 'Pendaftaran PPDB - ' . $request->asal_sekolah,
                'deskripsi'      => 'Pengajuan PPDB atas nama ' . $request->nama_pemohon,
                'status'         => 'Menunggu',
            ]);

            $pathIjazah = $request->file('file_ijazah') ? $request->file('file_ijazah')->store('ppdb', 'public') : null;
            $pathKK = $request->file('file_kk') ? $request->file('file_kk')->store('ppdb', 'public') : null;

            PpdbRegistration::create([
                'ticket_id'      => $ticket->id,
                'nisn'           => $request->nisn,
                'nik'            => $request->nik,
                'tempat_lahir'   => $request->tempat_lahir,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'asal_sekolah'   => $request->asal_sekolah,
                'alamat_lengkap' => $request->alamat_lengkap,
                'file_ijazah_skl'=> $pathIjazah,
                'file_kk'        => $pathKK,
            ]);

            return redirect()->route('ticket.track', ['ticket_code' => $ticket->ticket_code])
                ->with('success', 'Pendaftaran PPDB Berhasil Diajukan!');
        });
    }

    // Form Surat
    public function formSurat() { return view('services.surat'); }

    // Simpan Surat
    public function storeSurat(Request $request)
    {
        $request->validate([
            'nama_pemohon'    => 'required|string|max:255',
            'kontak_pemohon'  => 'required|string',
            'jenis_surat'     => 'required|string',
            'nisn_nip_pemohon'=> 'nullable|string',
            'kelas_jabatan'   => 'nullable|string',
            'deskripsi'       => 'required|string',
            'file_pendukung'  => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        return DB::transaction(function () use ($request) {
            $ticket = Ticket::create([
                'ticket_code'    => Ticket::generateTicketCode('SRT'),
                'type'           => 'SRT',
                'nama_pemohon'   => $request->nama_pemohon,
                'kontak_pemohon' => $request->kontak_pemohon,
                'judul_layanan'  => 'Permohonan Surat: ' . $request->jenis_surat,
                'deskripsi'      => $request->deskripsi,
                'status'         => 'Menunggu',
            ]);

            $filePath = $request->file('file_pendukung') ? $request->file('file_pendukung')->store('surat', 'public') : null;

            SuratRequest::create([
                'ticket_id'       => $ticket->id,
                'jenis_surat'      => $request->jenis_surat,
                'nisn_nip_pemohon' => $request->nisn_nip_pemohon,
                'kelas_jabatan'    => $request->kelas_jabatan,
                'file_pendukung'   => $filePath,
            ]);

            return redirect()->route('ticket.track', ['ticket_code' => $ticket->ticket_code])
                ->with('success', 'Permohonan Surat Berhasil Dikirim!');
        });
    }

    // Form Pengaduan Anonim (ADU)
    public function formPengaduan() { return view('services.pengaduan'); }

    // Simpan Pengaduan
    public function storePengaduan(Request $request)
    {
        $isAnonymous = $request->has('is_anonymous');

        $request->validate([
            'nama_pemohon'   => $isAnonymous ? 'nullable' : 'required|string',
            'kontak_pemohon' => $isAnonymous ? 'nullable' : 'required|string',
            'judul_layanan'  => 'required|string',
            'deskripsi'      => 'required|string',
        ]);

        $ticket = Ticket::create([
            'ticket_code'    => Ticket::generateTicketCode('ADU'),
            'type'           => 'ADU',
            'nama_pemohon'   => $isAnonymous ? 'Anonim / Rahasia' : $request->nama_pemohon,
            'kontak_pemohon' => $isAnonymous ? '-' : $request->kontak_pemohon,
            'judul_layanan'  => $request->judul_layanan,
            'deskripsi'      => $request->deskripsi,
            'is_anonymous'   => $isAnonymous,
            'status'         => 'Menunggu',
        ]);

        return redirect()->route('ticket.track', ['ticket_code' => $ticket->ticket_code])
            ->with('success', 'Pengaduan / Masukan Anda Berhasil Terkirim!');
    }

    // Form Jadwal Temu (JTM)
    public function formJadwalTemu() { return view('services.jadwal_temu'); }

    // Simpan Jadwal Temu
    public function storeJadwalTemu(Request $request)
    {
        $request->validate([
            'nama_pemohon'  => 'required|string',
            'kontak_pemohon'=> 'required|string',
            'tujuan_temu'   => 'required|string',
            'tanggal_temu'  => 'required|date|after_or_equal:today',
            'waktu_temu'    => 'required',
            'deskripsi'     => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {
            $ticket = Ticket::create([
                'ticket_code'    => Ticket::generateTicketCode('JTM'),
                'type'           => 'JTM',
                'nama_pemohon'   => $request->nama_pemohon,
                'kontak_pemohon' => $request->kontak_pemohon,
                'judul_layanan'  => 'Jadwal Temu: ' . $request->tujuan_temu,
                'deskripsi'      => $request->deskripsi,
                'status'         => 'Menunggu',
            ]);

            JadwalTemuRequest::create([
                'ticket_id'    => $ticket->id,
                'tujuan_temu'  => $request->tujuan_temu,
                'tanggal_temu' => $request->tanggal_temu,
                'waktu_temu'   => $request->waktu_temu,
            ]);

            return redirect()->route('ticket.track', ['ticket_code' => $ticket->ticket_code])
                ->with('success', 'Permohonan Jadwal Temu Berhasil Dikirim!');
        });
    }

    // Menampilkan halaman form pencarian resi
    public function checkStatus()
    {
        return view('services.check');
    }

    // Memproses pencarian berdasarkan kode resi
    public function searchStatus(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string',
        ]);

        $service = \App\Models\ServiceTicket::where('tracking_code', $request->tracking_code)->first();

        if (!$service) {
            return back()->with('error', 'Nomor resi tiket tidak ditemukan. Periksa kembali kode Anda.');
        }

        return view('services.check', compact('service'));
    }
}
