<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use Illuminate\Support\Facades\Cache;

class ZoneController extends Controller
{
    public function __invoke()
    {
        return Cache::remember('zone', 60 * 60 * 12 * 7, function () {
            return ZoneResource::collection(Zone::all());
        });
    }
}
