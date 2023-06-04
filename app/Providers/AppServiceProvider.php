<?php

namespace App\Providers;

use App\Models\Parking;
use App\Models\Reservation;
use App\Models\Vehicles;
use App\Observers\ParkingObserve;
use App\Observers\ReservationObserver;
use App\Observers\VehiclesObserve;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Parking::observe(ParkingObserve::class);
        Vehicles::observe(VehiclesObserve::class);
        Reservation::observe(ReservationObserver::class);
    }
}
