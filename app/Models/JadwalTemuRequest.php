<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalTemuRequest extends Model
{
    protected $fillable = ['ticket_id', 'tujuan_temu', 'tanggal_temu', 'waktu_temu'];
}
