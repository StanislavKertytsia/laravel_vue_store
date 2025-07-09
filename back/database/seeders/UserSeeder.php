<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'John',
            'last_name' => 'Doe',
            'phone' => '+1234567890',
            'email' => 'john@example.com',
            'avatar' => 'https://i.pravatar.cc/150?img=3',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'roles' => 'admin',
        ]);
    }
}
