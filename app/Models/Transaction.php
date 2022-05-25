<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\User;
use ReflectionClass;
use App\Helpers\Price;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'hash_id', 'user_id', 'type', 'game_season_id', 'nft_id',
        'status', 'description', 'transaction_date', 'decimals',
        'usdt', 'mspc'
    ];

    const TYPE_PURCHASE_TICKET = 'purchase_ticket';
    const TYPE_PURCHASE_NFT = 'purchase_nft';
    const TYPE_REWARD_PRIZE = 'reward_prize';
    const TYPE_REWARD_BONUS = 'reward_bonus';

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    // functions
    protected static function boot()
    {
        parent::boot();

        self::observe(TransactionObserver::class);
    }

    public function getTransactionType(): array
    {
        $constants = (new ReflectionClass($this))->getConstants();

        $data = [];

        foreach ($constants as $var => $value) {

            if (str_contains($var, 'TYPE_')) {
                $data[] = $value;
            }
        }

        return $data;
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function nft()
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }

    // scopes
    public function scopePurchaseTicket($query)
    {
        return $query->where('type', self::TYPE_PURCHASE_TICKET);
    }

    public function scopePurchaseNft($query)
    {
        return $query->where('type', self::TYPE_PURCHASE_NFT);
    }

    public function scopePrizeReward($query)
    {
        return $query->where('type', self::TYPE_REWARD_PRIZE);
    }

    public function scopeBonusReward($query)
    {
        return $query->where('type', self::TYPE_REWARD_BONUS);
    }

    // attributes
    public function getFormattedUsdtAttribute()
    {
        return (new Price())->getPriceInDecimals($this->usdt, $this->decimals);
    }

    public function getFormattedMspcAttribute()
    {
        return (new Price())->getPriceInDecimals($this->mspc, $this->decimals);
    }
}
