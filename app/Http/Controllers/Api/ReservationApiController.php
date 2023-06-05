<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreReservation;
use App\Http\Requests\Api\UpdateReservation;
use App\Http\Resources\Api\ReservationResource;
use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Models\Zone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/**
 * @group Reservation
 */
class ReservationApiController extends Controller
{
    public ReservationRepositoryInterface  $reservationRepository;

    // public function __construct(ReservationRepositoryInterface $reservationRepository)
    // {
    //     $this->reservationRepository = $reservationRepository;
    // }

    public function index(Request $request): JsonResponse
    {
        $searchItems = $request->except([
            'page',
            'limit',
        ]);
        $limit = $request->limit ?? 10;

        $data = ReservationResource::collection($this->reservationRepository->getAllData($limit, $searchItems, 'created_at', 'desc'));

        return response()->json([
            'status' => 200,
            'message' => ' get all items',
            'data' => $data,
        ]);
    }

    public function store(StoreReservation $request)
    {
        $zone = Zone::findOrFail(request()->zone_id);

        if ($zone->hasAvailableSpots()) {
            return response()->json([
                'message' => 'No available spots in this zone',
            ], Response::HTTP_BAD_REQUEST);
        }

        $reservation = Reservation::create($request->all());

        $zone->decrement('available_spots');

        return ReservationResource::make($reservation);
    }

    public function show(Request $request): JsonResponse
    {
        $reservationId = $request->get('id');
        $item = $this->reservationRepository->getItemById($reservationId);
        if (! $item) {
            return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'Not Found.',
            ]);
        } else {
            $item = new ReservationResource($item);

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Item Retrieved Successfully.',
                'data' => $item,
            ]);
        }
    }

    public function update(UpdateReservation $request, Reservation $reservation): JsonResponse
    {
        $reservation->update($request->all());

        return response()->json([
            'data' => $reservation,
        ], Response::HTTP_ACCEPTED);
    }

    public function delete(Reservation $reservation)
    {
        $reservation->delete();

        return response()->noContent();
    }

    public function confirm(Request $request): JsonResponse
    {
        return $this->updateReservationStatus(
            (int) $request->id,
            'confirmed',
            'Reservation confirmed successfully'
        );
    }

    public function reject(Request $request): JsonResponse
    {
        return $this->updateReservationStatus(
            (int) $request->id,
            'rejected',
            'Reservation rejected successfully'
        );
    }

    public function cancel(Request $request): JsonResponse
    {
        return $this->updateReservationStatus(
            (int) $request->id,
            'cancelled',
            'Reservation cancelled successfully'
        );
    }

    protected function updateReservationStatus(int $id, string $status, string $message): JsonResponse
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $status,
        ]);

        return response()->json([
            'message' => $message,
        ], Response::HTTP_OK);
    }
}
