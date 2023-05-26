<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use Illuminate\Http\Request;

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
