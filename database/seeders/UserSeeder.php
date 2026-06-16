<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Upsert admin (aman dijalankan berkali-kali)
        // Pastikan role tersedia sebelum menugaskan user
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'asesi']);
        Role::firstOrCreate(['name' => 'asesor']);

        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Role',
                'password' => bcrypt('admin'),
                'jurusan_id' => 1,
            ]
        );
        $admin->syncRoles(['admin']);

        // Upsert asesi biasa
        $user = User::updateOrCreate(
            ['email' => 'asesi@asesi.com'],
            [
                'name' => 'Asesi',
                'nik' => '1234567890123456',
                'password' => bcrypt('asesi'),
                'jurusan_id' => 1,
            ]
        );
        $user->syncRoles(['asesi']);

        $asesor = User::updateOrCreate(
            ['email' => 'asesor@asesor.com'],
            [
                'name' => 'Asesor',
                'password' => bcrypt('asesor'),
                'jurusan_id' => 1,
            ]
        );
        $asesor->syncRoles(['asesor']);
    }
}
