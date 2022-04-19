<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Relations\Pivot;

class NftTier extends Pivot
{
    protected $table = 'nft_tier';

    // relations
    public function nft()
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class, 'tier_id', 'id');
    }
}
