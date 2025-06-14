<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a specific user to be our Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@foodie.com',
            'password' => Hash::make('password'), // The password is 'password'
            'isAdmin' => true, // <-- THIS IS THE CORRECT COLUMN
            'address' => '123 Admin Street', // The table requires an address
        ]);

        // Create a specific user to be a regular customer for testing
        User::create([
            'name' => 'Test User',
            'email' => 'user@foodie.com',
            'password' => Hash::make('password'), // The password is 'password'
            'isAdmin' => false, // <-- This user is NOT an admin
            'address' => '456 User Avenue', // The table requires an address
        ]);
    }
}