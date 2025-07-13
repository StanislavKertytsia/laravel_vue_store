<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'Guest',
            'last_name' => 'Guest',
            'email' => 'guest@example.com',
            'phone' => '+0111111111',
            'roles' => ['user'],
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '+0999999999',
            'roles' => ['admin'],
        ]);

        Product::factory(100)->create();
    }
}
