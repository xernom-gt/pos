<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Elektronik',
                'description' => 'Produk-produk elektronik seperti smartphone, laptop, dan aksesori.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion Pria',
                'description' => 'Pakaian dan aksesori untuk pria.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'description' => 'Barang-barang untuk keperluan dapur dan rumah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}