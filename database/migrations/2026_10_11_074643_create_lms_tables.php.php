<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Materi Pelajaran
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('mata_pelajaran');
            $table->string('kelas'); // Contoh: X IPA 1, XI IPS 2
            $table->string('judul_materi');
            $table->text('deskripsi')->nullable();
            $table->string('file_materi')->nullable(); // PDF/PPT/Doc
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel Tugas Siswa
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('judul_tugas');
            $table->text('instruksi');
            $table->dateTime('tenggat_waktu');
            $table->string('file_tugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('courses');
    }
};
