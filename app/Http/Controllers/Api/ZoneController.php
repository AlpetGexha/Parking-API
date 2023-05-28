<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ZoneResource;
use App\Models\Zone;
use Illuminate\Support\Facades\Cache;

class ZoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Cache::remember('zone', 60 * 60 * 12 * 7, function () {
            return ZoneResource::collection(Zone::all());
        });

    }
}
