<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Tier;
use App\Models\User;
use App\Helpers\Status;
use App\Models\NftStar;
use App\Models\NftTier;
use App\Helpers\Moralis;
use App\Helpers\DateTime;
use App\Models\GameHistory;
use App\Observers\NftObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nft extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'nfts';

    protected $fillable = [
        'token_id', 'status', 'image', 'properties'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    // override
    public static function boot()
    {
        parent::boot();

        self::observe(NftObserver::class);
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tiers()
    {
        return $this->belongsToMany(Tier::class, NftTier::class, 'nft_id', 'tier_id')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function currentTier()
    {
        return $this->belongsToMany(Tier::class, NftTier::class, 'nft_id', 'tier_id')
            ->wherePivot('status', Status::STATUS_ACTIVE);
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', Status::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', Status::STATUS_INACTIVE);
    }

    // attributes
    public function getCurrentStarsAttribute()
    {
        if (is_null($this->stars_sum_quantity)) {
            return 0;
        }

        return $this->stars_sum_quantity - $this->currentTier->first()->stars_required;
    }

    public function getBestScoreAttribute()
    {
        return $this->game_histories_max_points ?? 0;
    }

    public function getWorstScoreAttribute()
    {
        return $this->game_histories_min_points ?? 0;
    }

    public function getAverageScoreAttribute()
    {
        return $this->game_histories_avg_points ?? 0;
    }

    public function getTotalScoreAttribute()
    {
        return $this->game_histories_sum_points ?? 0;
    }

    public function getTotalPlayCountAttribute()
    {
        return $this->game_histories_count ?? 0;
    }

    public function getTotalHoursPlayedAttribute()
    {
        if (is_null($this->game_histories_sum_duration)) {
            return 0;
        }

        return (new DateTime())->convertFromMillisecondsToReadable($this->game_histories_sum_duration);
    }

    public function getWinningRateAttribute()
    {
        return ($this->average_score * 100) . '%';
    }

    public function getCurrentStarsWithTierStarsAttribute()
    {
        return $this->current_stars . '/5';
    }
}
