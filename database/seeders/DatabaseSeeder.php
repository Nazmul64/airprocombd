<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing users (optional - uncomment if needed)
        // User::truncate();

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin@gmail.com'),
            'role' => 'admin',
            'username' => null,
            'phone' => null,
            'walate_address' => 'default_address',
        ]);

        // Create regular user
        User::create([
            'name' => 'Nazmul',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('user@gmail.com'),
            'role' => 'user',
            'username' => 'nazmul',
            'phone' => '01706640864',
            'walate_address' => 'default_address',
        ]);

        // Alternative: Use factory to create multiple test users
        // User::factory(10)->create();

        // You can also call other seeders here
        // $this->call([
        //     UserSeeder::class,
        //     PostSeeder::class,
        // ]);
    }
}
