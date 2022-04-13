<?php

namespace App\Models;

use App\Models\Tier;
use App\Models\User;
use App\Models\NftStar;
use App\Models\NftTier;
use App\Models\GameHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nft extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'nfts';

    protected $fillable = [
        'token_id', 'status'
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tiers()
    {
        return $this->belongsToMany(Tier::class, NftTier::class, 'nft_id', 'tier_id')
            ->withTimestamps();
    }

    public function latestTier()
    {
        return $this->tiers()
            ->orderByDesc('created_at')
            ->first()
            ->pivot;
    }

    public function stars()
    {
        return $this->hasMany(NftStar::class, 'nft_id', 'id');
    }

    public function gameHistories()
    {
        return $this->hasMany(GameHistory::class, 'nft_id', 'id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, GameHistory::class, 'nft_id', 'game_id')
            ->withTimestamps()
            ->withPivot([
                'room_id', 'game_season_id', 'started_at', 'ended_at',
                'duration', 'points', 'position'
            ]);
    }
}
