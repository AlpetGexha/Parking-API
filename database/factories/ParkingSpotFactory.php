<?php

namespace Database\Factories;

use App\Models\Parking;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingSpot>
 */
class ParkingSpotFactory extends Factory
{
    public function definition(): array
    {
        return [
            'zone_id' => Zone::factory(),
            'parking_id' => Parking::factory(),
            'spot_numer' => $this->faker->randomElement(['A1', 'A2', 'A3', 'A4']),
            'is_available' => $this->faker->boolean(30),
        ];
    }
}
