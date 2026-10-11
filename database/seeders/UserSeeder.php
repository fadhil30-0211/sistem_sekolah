<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin / IT
        User::updateOrCreate(
            ['email' => 'admin@smanokura.sch.id'],
            [
                'name' => 'Super Admin IT',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'no_telepon' => '081234567890',
                'nip_nisn' => 'ADM001',
            ]
        );

        // 2. Kepala Sekolah
        User::updateOrCreate(
            ['email' => 'kepala@smanokura.sch.id'],
            [
                'name' => 'Dr. H. Ahmad Kepala, M.Pd.',
                'password' => Hash::make('password123'),
                'role' => 'kepala_sekolah',
                'no_telepon' => '081234567891',
                'nip_nisn' => '196805121990031001',
            ]
        );

        // 3. Guru
        User::updateOrCreate(
            ['email' => 'guru@smanokura.sch.id'],
            [
                'name' => 'Siti Aminah, S.Pd.',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'no_telepon' => '081234567892',
                'nip_nisn' => '198507202010012002',
            ]
        );

        // 4. Staf TU / Operator
        User::updateOrCreate(
            ['email' => 'tu@smanokura.sch.id'],
            [
                'name' => 'Budi Santoso, A.Md.',
                'password' => Hash::make('password123'),
                'role' => 'staf_tu',
                'no_telepon' => '081234567893',
                'nip_nisn' => '199203152015031003',
            ]
        );
    }
}
