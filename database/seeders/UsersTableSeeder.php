<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'level' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // replace 'password' with the admin's password
        ]);

        User::create([
            'level' => 'user',
            'name' => 'User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'), // replace 'password' with the user's password
        ]);
    }
}
