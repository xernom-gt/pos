<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'name' => 'Budi Santoso',
                'address' => 'Jl. Kenanga No. 5, Jakarta',
                'email' => 'budi.santo@example.com',
                'phone_number' => '081234567890',
                'status' => '1', // 1: Aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aminah',
                'address' => 'Komplek Mawar Indah Blok A, Bandung',
                'email' => 'siti.aminah@example.com',
                'phone_number' => '087654321098',
                'status' => '1', // 1: Aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Joko Permana',
                'address' => 'Perumahan Sejahtera, Surabaya',
                'email' => 'joko.permana@example.com',
                'phone_number' => '085000111222',
                'status' => '0', // 0: Non-aktif/Pending
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}