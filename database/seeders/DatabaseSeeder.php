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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Vehicles::factory(100)->create();
        \App\Models\Parking::factory(100)->create();
        // \App\Models\Zone::factory(100)->create();
        \App\Models\ParkingSpot::factory(100)->create();
        \App\Models\Reservation::factory(20)->create();

        $this->call([
            // UserSeeder::class,
            // ParkingSeeder::class,
            ZoneSeeder::class,
            // ParkingSpotSeeder::class,
        ]);
    }
}
