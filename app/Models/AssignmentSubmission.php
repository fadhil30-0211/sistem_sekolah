<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'nama_siswa',
        'kelas_siswa',
        'file_jawaban',
        'catatan_siswa',
        'nilai',
        'catatan_guru'
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
