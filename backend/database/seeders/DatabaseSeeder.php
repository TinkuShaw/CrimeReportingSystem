<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed lookup tables first to satisfy foreign key constraints
        $this->call([
            PoliceUnitSeeder::class,
            PoliceStationSeeder::class,
            ComplaintTypeSeeder::class,
        ]);

        // Create or Update Police Account
        User::updateOrCreate(
            ['email' => 'mishrapradip@gmail.com'],
            [
                'name'     => 'Officer Pradip',
                'mobile'   => '9847521661',
                'role'     => 'police',
                'password' => Hash::make('password123'), // Securely hash password
            ]
        );

        // Create or Update Admin Account
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'System Admin',
                'mobile'   => '0181234567',
                'role'     => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}