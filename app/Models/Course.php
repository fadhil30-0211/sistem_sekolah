<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_pelajaran',
        'kelas',
        'judul_materi',
        'deskripsi',
        'file_materi',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
