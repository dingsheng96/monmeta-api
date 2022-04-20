<?php

namespace App\Models;

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
        'hash_id', 'sourceable_type', 'sourceable_id',
        'type', 'status', 'amount', 'decimals', 'description',
        'transaction_date', 'currency'
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

    // relations
    public function sourceable()
    {
        return $this->morphTo();
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
    public function getFormattedAmountAttribute()
    {
        return (new Price())->getPriceInDecimals($this->amount, $this->decimals);
    }
}
