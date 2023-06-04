<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreVehiclesRequest;
use App\Http\Resources\Api\VehiclesResource;
use App\Models\vehicles;
use Illuminate\Http\Response;

class VehiclesController extends Controller
{
    public function index()
    {
        return VehiclesResource::collection(Vehicles::all());
    }

    public function store(StoreVehiclesRequest $request)
    {
        $vehicle = Vehicles::create($request->validated());

        return VehiclesResource::make($vehicle);
    }

    public function show(Vehicles $vehicle)
    {
        return VehiclesResource::make($vehicle);
    }

    public function update(StoreVehiclesRequest $request, Vehicles $vehicle)
    {
        $vehicle->update($request->validated());

        return response()->json(VehiclesResource::make($vehicle), Response::HTTP_ACCEPTED);
    }

    public function destroy(Vehicles $vehicle)
    {
        $vehicle->delete();

        return response()->noContent();
    }
}
