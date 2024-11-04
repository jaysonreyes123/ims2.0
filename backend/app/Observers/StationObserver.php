<?php

namespace App\Observers;

use App\Models\Station;

class StationObserver
{
    /**
     * Handle the Station "created" event.
     */
    public function created(Station $station): void
    {
        //
    }

    /**
     * Handle the Station "updated" event.
     */
    public function updated(Station $station): void
    {
        //
    }

    /**
     * Handle the Station "deleted" event.
     */
    public function deleted(Station $station): void
    {
        //
    }

    /**
     * Handle the Station "restored" event.
     */
    public function restored(Station $station): void
    {
        //
    }

    /**
     * Handle the Station "force deleted" event.
     */
    public function forceDeleted(Station $station): void
    {
        //
    }
}
