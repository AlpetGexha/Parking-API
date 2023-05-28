<?php

namespace App\Observers;

use App\Models\Vehicles;

class VehiclesObserve
{
    /**
     * Handle the Vehicles "created" event.
     */
    public function created(Vehicles $vehicles): void
    {
        //
    }

    public function creating(Vehicles $vehicles): void
    {
        if (auth()->check()) {
            $vehicles->user_id = auth()->id();
        }
    }

    /**
     * Handle the Vehicles "updated" event.
     */
    public function updated(Vehicles $vehicles): void
    {
        //
    }

    /**
     * Handle the Vehicles "deleted" event.
     */
    public function deleted(Vehicles $vehicles): void
    {
        //
    }

    /**
     * Handle the Vehicles "restored" event.
     */
    public function restored(Vehicles $vehicles): void
    {
        //
    }

    /**
     * Handle the Vehicles "force deleted" event.
     */
    public function forceDeleted(Vehicles $vehicles): void
    {
        //
    }
}
