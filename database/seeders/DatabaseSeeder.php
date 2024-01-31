<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // $this->call([
         //     UserSeeder::class
         // ]);
        \App\Models\User::create(['name' => 'Admin', 'email' => 'admin@local.com', 'password' => bcrypt('123456')]);
        \App\Models\User::factory(200)->create();
        \App\Models\Challenge::factory(50)->create();
        \App\Models\Order::factory(10)->create();
        // foreach (User::all() as $user) {
        //     if (rand(0,1)) {
        //         \App\Models\Challenge::factory()->create();
        //     }
        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
