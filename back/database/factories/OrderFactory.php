<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total' => 0,
            'status' => 'pending',
        ];
    }
}
