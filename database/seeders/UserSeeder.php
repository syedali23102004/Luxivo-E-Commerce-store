<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Seed the database with regular users.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        $users = [
            [
                'name' => 'Ahmed Ali',
                'email' => 'ahmed.ali@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '03001234567',
                'address' => 'Karachi, Pakistan',
            ],
            [
                'name' => 'Sara Khan',
                'email' => 'sara.khan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '03002234567',
                'address' => 'Islamabad, Pakistan',
            ],
            [
                'name' => 'Bilal Ahmed',
                'email' => 'bilal.ahmed@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '03003234567',
                'address' => 'Lahore, Pakistan',
            ],
            [
                'name' => 'Fatima Malik',
                'email' => 'fatima.malik@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '03004234567',
                'address' => 'Multan, Pakistan',
            ],
            [
                'name' => 'Usman Sheikh',
                'email' => 'usman.sheikh@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '03005234567',
                'address' => 'Peshawar, Pakistan',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
                'phone' => $user['phone'],
                'address' => $user['address'],
                'email_verified_at' => now(),
            ]);
        }
    }
}
