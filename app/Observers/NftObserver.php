<?php

namespace App\Observers;

use App\Models\Nft;
use App\Support\Services\NftService;

class NftObserver
{
    /**
     * Handle the Nft "created" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function created(Nft $nft)
    {
        (new NftService())->setModel($nft)
            ->setRequest(request())
            ->updateNftImage();
    }

    /**
     * Handle the Nft "creating" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function creating(Nft $nft)
    {
        //
    }

    /**
     * Handle the Nft "updated" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function updated(Nft $nft)
    {
        //
    }

    /**
     * Handle the Nft "deleted" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function deleted(Nft $nft)
    {
        //
    }

    /**
     * Handle the Nft "restored" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function restored(Nft $nft)
    {
        //
    }

    /**
     * Handle the Nft "force deleted" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function forceDeleted(Nft $nft)
    {
        //
    }
}
