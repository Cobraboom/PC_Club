<?php

namespace App\Observers;

use App\Models\PC_ClubPC;

class PC_Observer
{
    /**
     * Handle the models p c_ club p c "created" event.
     *
     * @param  \App\Models\PC_ClubPC  $PC_ClubPC
     * @return void
     */
    public function created(PC_ClubPC $PC_ClubPC)
    {
        //
    }

    /**
     * Handle the models p c_ club p c "updated" event.
     *
     * @param  \App\Models\PC_ClubPC  $PC_ClubPC
     * @return void
     */
    public function updated(PC_ClubPC $PC_ClubPC)
    {
        //
    }

    /**
     * Handle the models p c_ club p c "deleted" event.
     *
     * @param  \App\Models\PC_ClubPC  $PC_ClubPC
     * @return void
     */
    public function deleted(PC_ClubPC $PC_ClubPC)
    {
        //
    }

    /**
     * Handle the models p c_ club p c "restored" event.
     *
     * @param  \App\Models\PC_ClubPC  $PC_ClubPC
     * @return void
     */
    public function restored(PC_ClubPC $PC_ClubPC)
    {
        //
    }

    /**
     * Handle the models p c_ club p c "force deleted" event.
     *
     * @param  \App\Models\PC_ClubPC  $PC_ClubPC
     * @return void
     */
    public function forceDeleted(PC_ClubPC $PC_ClubPC)
    {
        //
    }
}
