<?php

namespace App\Models;

use App\Models\Nft;
use App\Helpers\Price;
use App\Models\Country;
use App\Models\GameHistory;
use App\Models\Transaction;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_id', 'first_name', 'last_name', 'username',
        'email', 'nationality_id', 'contact_no',
        'total_purchase', 'total_prize_claim', 'balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'wallet_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    // relations
    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id', 'id');
    }

    public function nfts()
    {
        return $this->hasMany(Nft::class, 'nft_id', 'id');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'sourceable');
    }

    public function gameHistories()
    {
        return $this->hasManyThrough(GameHistory::class, Nft::class, 'user_id', 'nft_id', 'id', 'id');
    }

    // attributes
    public function getTotalPrizesAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->prizeReward()
                    ->orWhere(fn ($query) => $query->bonusReward());
            })->sum('amount');
    }

    public function getTotalBuyInAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->purchaseTicket()
                    ->orWhere(fn ($query) => $query->purchaseNft());
            })->sum('amount');
    }

    public function getProfitLossAttribute(): int
    {
        return (int) $this->total_prizes - $this->total_buy_in;
    }

    public function getFormattedTotalPrizesAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->total_prizes, $this->decimals);
    }

    public function getFormattedTotalBuyInAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->total_buy_in, $this->decimals);
    }

    public function getFormattedProfitLossAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->profit_loss, $this->decimals);
    }

    public function getFormattedTotalPurchaseAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->total_purchase, $this->decimals);
    }

    public function getFormattedTotalPrizeClaimAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->total_prize_claim, $this->decimals);
    }

    public function getFormattedBalanceAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->balance, $this->decimals);
    }
}
