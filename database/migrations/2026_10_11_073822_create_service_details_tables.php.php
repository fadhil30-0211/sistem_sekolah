<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Detail Pendaftaran PPDB
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('asal_sekolah');
            $table->text('alamat_lengkap');
            $table->string('file_ijazah_skl')->nullable();
            $table->string('file_kk')->nullable();
            $table->timestamps();
        });

        // Detail Layanan Surat (SRT)
        Schema::create('surat_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('jenis_surat'); // Keterangan Aktif, Surat Pengantar, dll.
            $table->string('nisn_nip_pemohon')->nullable();
            $table->string('kelas_jabatan')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();
        });

        // Detail Jadwal Temu / Konsultasi (JTM)
        Schema::create('jadwal_temu_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->string('tujuan_temu'); // Guru / Wali Kelas / Guru BK / Kepala Sekolah
            $table->date('tanggal_temu');
            $table->time('waktu_temu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_temu_requests');
        Schema::dropIfExists('surat_requests');
        Schema::dropIfExists('ppdb_registrations');
    }
};
