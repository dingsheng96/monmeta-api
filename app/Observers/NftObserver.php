<?php

namespace App\Observers;

use App\Models\Nft;
use App\Helpers\Moralis;

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
        //
    }

    /**
     * Handle the Nft "creating" event.
     *
     * @param  \App\Models\Nft  $nft
     * @return void
     */
    public function creating(Nft $nft)
    {
        $nftDetail = (new Moralis())->getUserNftDetails(request()->user()->wallet_id, $nft->token_id);

        if (!empty($nftDetail)) {
            $metaData = json_decode($nftDetail['metadata']);

            $nft->image = $metaData->image;
            $nft->properties = $metaData;
        }
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
