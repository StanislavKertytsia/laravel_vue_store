<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(640, 480, 'product', true),
        ];
    }
}
