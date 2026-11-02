<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => 'password123',
            ]
        );

        $admin->syncRoles(['Admin']);


        // Membuat akun Dosen
        $dosen = User::updateOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Dosen',
                'password' => 'password123',
            ]
        );

        $dosen->syncRoles(['Dosen']);


        // Membuat akun Mahasiswa
        $mahasiswa = User::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa',
                'password' => 'password123',
            ]
        );

        $mahasiswa->syncRoles(['Mahasiswa']);
    }
}
