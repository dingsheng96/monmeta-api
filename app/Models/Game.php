<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\GameHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'games';

    protected $fillable = [
        'uuid', 'name'
    ];

    // relations
    public function gameHistories()
    {
        return $this->hasMany(GameHistory::class, 'game_id', 'id');
    }

    public function nfts()
    {
        return $this->belongsToMany(Nft::class, GameHistory::class, 'game_id', 'nft_id')
            ->withTimestamps()
            ->withPivot([
                'room_id', 'game_season_id', 'started_at', 'ended_at',
                'duration', 'points', 'position'
            ]);
    }
}
