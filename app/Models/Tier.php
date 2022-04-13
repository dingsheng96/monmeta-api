<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\NftTier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tier extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'tiers';

    protected $fillable = [
        'name', 'require_stars'
    ];

    // relations
    public function nfts()
    {
        return $this->belongsToMany(Nft::class, NftTier::class, 'tier_id', 'nft_id')
            ->withTimestamps();
    }
}
