<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LmsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil akun guru pertama yang ada di database
        $guru = User::where('role', 'guru')->first();
        $guruId = $guru ? $guru->id : 1;

        // Buat Materi Pelajaran
        $course1 = Course::create([
            'mata_pelajaran' => 'Pemrograman Web / Laravel',
            'kelas'          => 'XI IPA 1',
            'judul_materi'   => 'Pengenalan Konsep MVC & Routing Laravel',
            'deskripsi'      => 'Mempelajari dasar-dasar arsitektur Model-View-Controller dan pengelolaan rute dalam framework Laravel.',
            'guru_id'        => $guruId,
        ]);

        // Buat Tugas untuk Materi tersebut
        Assignment::create([
            'course_id'     => $course1->id,
            'judul_tugas'   => 'Tugas 1: Membuat Routing & Controller Sederhana',
            'instruksi'     => 'Buatlah sebuah controller baru dan tampilkan view selamat datang dengan nama Anda. Kumpul dalam bentuk file ZIP.',
            'tenggat_waktu' => Carbon::now()->addDays(7),
        ]);

        $course2 = Course::create([
            'mata_pelajaran' => 'Desain Grafis / UI-UX',
            'kelas'          => 'XII IPS 2',
            'judul_materi'   => 'Dasar-Dasar Tata Letak Bento Grid',
            'deskripsi'      => 'Memahami prinsip grid modern, hierarki visual, dan pemilihan palet warna untuk antarmuka web.',
            'guru_id'        => $guruId,
        ]);

        Assignment::create([
            'course_id'     => $course2->id,
            'judul_tugas'   => 'Tugas Desain: Layout Bento Portal Sekolah',
            'instruksi'     => 'Buat sketsa rancangan bento grid untuk halaman profil sekolah menggunakan Figma atau gambar tangan.',
            'tenggat_waktu' => Carbon::now()->addDays(5),
        ]);
    }
}
