<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'zone_id' => Zone::factory(),
            'spot_numer' => $this->faker->randomElement(['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7']),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('now', '+1 day'),
        ];
    }
}
