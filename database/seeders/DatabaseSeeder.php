<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'role' => 'employee',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'role' => 'client',
        ]);

        // Create Categories
        $categories = \App\Models\Category::factory(5)->create();

        // Create Guinea Pigs
        \App\Models\GuineaPig::factory(50)->recycle($categories)->create();

        // Create Services
        \App\Models\Service::factory(5)->create();

        // Create Products
        \App\Models\Product::factory(20)->create();

        // Create Users
        \App\Models\User::factory(10)->create();
    }
}
