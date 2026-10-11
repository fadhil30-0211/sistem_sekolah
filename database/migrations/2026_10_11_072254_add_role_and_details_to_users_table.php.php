<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'kepala_sekolah', 'guru', 'staf_tu', 'siswa'])->default('siswa')->after('email');
            $table->string('no_telepon')->nullable()->after('role');
            $table->string('nip_nisn')->nullable()->after('no_telepon');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'no_telepon', 'nip_nisn']);
        });
    }
};
