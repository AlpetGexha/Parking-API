<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'zone' => [
                'name' => $this->zone->name,
                'price_per_hour' => $this->zone->price_per_hour,
            ],
            'vehicle' => [
                'plate_number' => $this->vehicle->plate_number,
                'brand' => $this?->vehicle->brand,
                'model' => $this?->vehicle->model,
            ],
            'start_time' => $this->start_time,
            'end_time' => $this?->end_time, // ->toDateTimeString() to avoid errors about using a method on a null object value.
            'total_price' => $this->total_price,
            'is_active' => $this?->is_active,
        ];
    }
}
