<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Hero Slider
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('subjudul')->nullable();
            $table->string('gambar'); // URL / Storage Path
            $table->string('link_button')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Tabel Berita & Pengumuman
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->enum('kategori', ['Berita', 'Pengumuman', 'Prestasi', 'Kegiatan']);
            $table->text('konten');
            $table->string('gambar_sampul')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // Tabel Polymorphic Media (Foto/Video MP4/WebM & Embed Youtube/Vimeo)
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable'); // Generates mediable_type & mediable_id
            $table->enum('type', ['image', 'video_file', 'video_embed']);
            $table->string('file_path')->nullable(); // Untuk upload MP4/WebM atau Image
            $table->string('embed_url')->nullable(); // Untuk YouTube / Vimeo
            $table->string('caption')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('hero_slides');
    }
};
