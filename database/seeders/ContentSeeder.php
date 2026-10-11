<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'super_admin')->first();

        Post::create([
            'judul' => 'Pembukaan PPDB SMAN Okura Tahun Ajaran Baru',
            'slug' => Str::slug('Pembukaan PPDB SMAN Okura Tahun Ajaran Baru'),
            'kategori' => 'Pengumuman',
            'konten' => 'Pendaftaran Peserta Didik Baru (PPDB) SMAN Okura resmi dibuka. Calon siswa dapat mendaftar secara online melalui portal resmi.',
            'author_id' => $admin->id ?? 1,
            'is_published' => true,
        ]);

        Post::create([
            'judul' => 'Siswa SMAN Okura Meraih Juara Lomba Sains Provinsi',
            'slug' => Str::slug('Siswa SMAN Okura Meraih Juara Lomba Sains Provinsi'),
            'kategori' => 'Prestasi',
            'konten' => 'Prestasi membanggakan kembali diraih oleh tim Olimpiade Sains SMAN Okura pada ajang kompetisi tingkat provinsi.',
            'author_id' => $admin->id ?? 1,
            'is_published' => true,
        ]);
    }
}
