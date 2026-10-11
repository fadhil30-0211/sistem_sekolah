<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratRequest extends Model
{
    protected $fillable = ['ticket_id', 'jenis_surat', 'nisn_nip_pemohon', 'kelas_jabatan', 'file_pendukung'];
}
