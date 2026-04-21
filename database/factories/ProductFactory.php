<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,  // ambil kategori yang sudah ada secara acak
            'name'        => $this->faker->words(3, true),           // contoh: "Wireless Mouse Pro"
            'price'       => $this->faker->numberBetween(50000, 5000000),
            'stock'       => $this->faker->numberBetween(5, 200),
        ];
    }
}