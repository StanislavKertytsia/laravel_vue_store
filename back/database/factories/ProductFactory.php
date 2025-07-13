<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->word(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 5, 1000),
            'image' => $this->faker->imageUrl(640, 480, 'product', true),
            'stock' => $this->faker->numberBetween(0, 10),
        ];
    }
}
