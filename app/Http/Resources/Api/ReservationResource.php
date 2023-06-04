<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'zone_id' => $this->zone_id,
            'spot_numer' => $this->spot_numer ?? null,
            'start_time' => $this->start_time ?? null,
            'status' => $this->status,
            'end_time' => $this->end_time ?? null,
        ];
    }
}
