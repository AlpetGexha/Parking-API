<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicles;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parking>
 */
class ParkingFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'vehicle_id' => Vehicles::factory(),
            'zone_id' => Zone::factory(),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
            'is_active' => $this->faker->boolean(30),
        ];
    }
}
