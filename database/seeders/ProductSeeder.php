<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category; // Pastikan model Category ada

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari kategori yang sudah ada
        $electronicId = Category::where('name', 'Elektronik')->first()->id;
        $fashionPriaId = Category::where('name', 'Fashion Pria')->first()->id;
        $rumahTanggaId = Category::where('name', 'Peralatan Rumah Tangga')->first()->id;

        DB::table('products')->insert([
            [
                'name' => 'Smartphone Giga 12',
                'description' => 'Smartphone flagship dengan kamera 108MP dan baterai tahan lama.',
                'stock' => '50', // Menggunakan string sesuai migration
                'price' => '8500000', // Menggunakan string sesuai migration
                'category_id' => $electronicId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kemeja Flanel Merah',
                'description' => 'Kemeja flanel katun premium, nyaman dipakai untuk sehari-hari.',
                'stock' => '120',
                'price' => '250000',
                'category_id' => $fashionPriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mixer Roti Otomatis',
                'description' => 'Mixer dapur dengan kecepatan tinggi, ideal untuk membuat adonan roti.',
                'stock' => '30',
                'price' => '1200000',
                'category_id' => $rumahTanggaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}