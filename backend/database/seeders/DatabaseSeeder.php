<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update the Police account (prevents duplicate entries)
        User::updateOrCreate(
            ['email' => 'mishrapradip@gmail.com'],
            [
                'name'   => 'Officer Pradip',
                'mobile' => '9847521661',
                'role'   => 'police', // Critical for Police Dashboard access
            ]
        );

        // Create or update the Admin account
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'   => 'System Admin',
                'mobile' => '0181234567',
                'role'   => 'admin', // Critical for Admin Dashboard access
            ]
        );
    }
}