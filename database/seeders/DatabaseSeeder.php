<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'karim',
            'email' => 'karim@gmail.com',
            'password' => bcrypt('karim'),
        ]);
    }
}
