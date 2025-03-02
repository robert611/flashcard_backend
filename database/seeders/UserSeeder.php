<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'created_at' => now(),
        ]);
    }
}
