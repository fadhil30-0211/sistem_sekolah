<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $fillable = [
        'ticket_id', 'nisn', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'asal_sekolah', 'alamat_lengkap', 'file_ijazah_skl', 'file_kk'
    ];
}
