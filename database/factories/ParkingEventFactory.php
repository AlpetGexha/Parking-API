<?php

namespace Database\Factories;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingEvent>
 */
class ParkingEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parking_id' => Parking::factory(),
            'event_type' => $this->faker->randomElement(['start', 'end']),
            'event_time' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
