<?php

namespace App\Http\Resources\Api;

use App\Service\ParkingPriceService;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    public function toArray($request)
    {
        $totalPrice = $this->total_price ?? ParkingPriceService::calculatePrice(
            $this->zone_id,
            $this->start_time,
            $this->end_time
        );

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
            'total_price' => $totalPrice,
            'is_active' => $this?->is_active,
        ];
    }
}
