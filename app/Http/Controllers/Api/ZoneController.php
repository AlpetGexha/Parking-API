<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ZoneResource;
use App\Models\Zone;

class ZoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return ZoneResource::collection(Zone::all());
    }
}
