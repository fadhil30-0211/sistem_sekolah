<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique(); // Format: PREFIKS-YYYYMMDD-XXX
            $table->enum('type', ['PPDB', 'SRT', 'ADU', 'JTM']); // Jenis Layanan
            $table->string('nama_pemohon');
            $table->string('kontak_pemohon')->nullable(); // Email/WA
            $table->string('judul_layanan');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->text('catatan_petugas')->nullable();
            $table->boolean('is_anonymous')->default(false); // Khusus Pengaduan (ADU)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
