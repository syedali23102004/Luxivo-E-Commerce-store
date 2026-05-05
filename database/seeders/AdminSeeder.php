<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the database with admin user.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin LUXIVO',
            'email' => 'admin@luxivo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '03001234567',
            'address' => 'Lahore, Pakistan',
            'email_verified_at' => now(),
        ]);
    }
}
