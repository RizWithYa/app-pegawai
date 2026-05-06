<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Admin User
        User::updateOrCreate(
            ['email' => 'admin@lantara.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@lantara.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        // Buat Karyawan User
        User::updateOrCreate(
            ['email' => 'karyawan@lantara.com'],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@lantara.com',
                'password' => bcrypt('karyawan123'),
                'role' => 'karyawan',
            ]
        );
    }
}
