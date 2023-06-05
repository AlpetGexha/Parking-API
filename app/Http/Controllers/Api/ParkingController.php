<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParkingStoreRequest;
use App\Http\Requests\Api\UpdateParking;
use App\Http\Resources\Api\ParkingResource;
use App\Interfaces\ParkingRepositoryInterface;
use App\Models\Parking;
use App\Service\ParkingPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Pariking
 */
class ParkingController extends Controller
{
    public ParkingRepositoryInterface  $parkingRepository;

    // public function __construct(ParkingRepositoryInterface $parkingRepository)
    // {
    //     $this->parkingRepository = $parkingRepository;
    // }

    public function index()
    {
        $activeParkings = Parking::active()->latest('start_time')->get();

        return ParkingResource::collection($activeParkings);
    }

    public function store(ParkingStoreRequest $request): JsonResponse
    {
        if (Parking::active()->where('vehicle_id', $request->vehicle_id)->exists) {
            return response()->json([
                'errors' => ['general' => ['Can\'t start parking twice using same vehicle. Please stop currently active parking.']],
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $parking = $this->parkingRepository->createItem($request->validate());
        $parking->load('vehicle', 'zone');

        return ParkingResource::make($parking);
    }

    public function show(Parking $parking)
    {
        return ParkingResource::make($parking);
    }

    public function update(UpdateParking $request): JsonResponse
    {
        $parkingId = $request->get('id');

        $parkingDetails = $request->all();
        $data = $this->parkingRepository->updateItem($parkingId, $parkingDetails);

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully .',
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $parkingId = $request->get('id');
        $parkingItem = $this->parkingRepository->deleteItem($parkingId);

        if (! $parkingItem) {
            return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'Not Found.',
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Deleted Successfully .',
            ]);
        }
    }

    public function start(ParkingStoreRequest $request)
    {
        if (Parking::active()->where('vehicle_id', request()->vehicle_id)->exists()) {
            return response()->json([
                'errors' => ['general' => ['Can\'t start parking twice using same vehicle. Please stop currently active parking.']],
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $parking = Parking::create($request->all());
        $parking->load('vehicle', 'zone');

        return ParkingResource::make($parking);
    }

    public function stop(Parking $parking)
    {
        $parking->update([
            'stop_time' => now(),
            'total_price' => ParkingPriceService::calculatePrice($parking->zone_id, $parking->start_time),
        ]);

        return ParkingResource::make($parking);
    }
}
