<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        $name = [
            'Green Zone' => 100,
            'Yellow Zone' => 200,
            'Red Zone' => 300,
        ];

        foreach ($name as $name => $price_per_hour) {
            \App\Models\Zone::factory()->create([
                'name' => $name,
                'price_per_hour' => $price_per_hour,
            ]);
        }
    }
}
