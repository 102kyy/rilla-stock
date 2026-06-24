<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kiara Danisha',
            'email' => 'kiara@admin.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', 
        ]);

        User::create([
            'name' => 'Staff Rilla',
            'email' => 'staff@rilla.com',
            'password' => Hash::make('pegawai123'),
            'role' => 'pegawai',
        ]);
    }
}