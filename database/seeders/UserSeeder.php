<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh pengguna admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            // Password: 'password' (di-hash)
            'password' => Hash::make('password'), 
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Contoh pengguna reguler lainnya
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            // Password: 'password' (di-hash)
            'password' => Hash::make('password'), 
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Anda juga dapat menggunakan factory untuk membuat data dummy dalam jumlah besar
        // \App\Models\User::factory(10)->create();
    }
}