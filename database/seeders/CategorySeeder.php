<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Elektronik', 'Fashion', 'Makanan', 'Alat Tulis', 'Otomotif'];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);   // ← ini yang diperbaiki
        }
    }
}