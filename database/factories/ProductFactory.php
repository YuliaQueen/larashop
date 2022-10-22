<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'title'     => ucfirst($this->faker->words(2, true)),
            'thumbnail' => '',
            'price' => $this->faker->numberBetween(1000, 10000),
            'brand_id' => Brand::query()->inRandomOrder()->value('id')
        ];
    }
}
