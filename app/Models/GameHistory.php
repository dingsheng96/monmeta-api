<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\Game;
use App\Models\User;
use App\Helpers\DateTime;
use App\Observers\GameHistoryObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameHistory extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'game_histories';

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    // functions
    public static function boot()
    {
        parent::boot();

        self::observe(GameHistoryObserver::class);
    }
    // relations
    public function nft()
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Nft::class, 'id', 'id', 'nft_id', 'user_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    // Get Attributes
    public function getDurationInSecondsAttribute()
    {
        return $this->duration / 1000;
    }

    public function getFormattedDurationAttribute()
    {
        return (new DateTime())->convertFromMillisecondsToReadable($this->duration);
    }
}
