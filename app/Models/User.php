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
        return $this->hasMany(Nft::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function gameHistories()
    {
        return $this->hasManyThrough(GameHistory::class, Nft::class, 'user_id', 'nft_id', 'id', 'id');
    }

    // attributes
    public function getUsdtTotalPrizesAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->prizeReward()
                    ->orWhere(fn ($query) => $query->bonusReward());
            })->sum('usdt');
    }

    public function getUsdtTotalBuyInAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->purchaseTicket()
                    ->orWhere(fn ($query) => $query->purchaseNft());
            })->sum('usdt');
    }

    public function getUsdtProfitLossAttribute(): int
    {
        return (int) $this->usdt_total_prizes - $this->usdt_total_buy_in;
    }

    public function getFormattedUsdtTotalPrizesAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_total_prizes, $this->decimals);
    }

    public function getFormattedUsdtTotalBuyInAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_total_buy_in, $this->decimals);
    }

    public function getFormattedUsdtProfitLossAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_profit_loss, $this->decimals);
    }

    public function getFormattedUsdtTotalPurchaseAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_total_purchase, $this->decimals);
    }

    public function getFormattedUsdtTotalPrizeClaimAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_total_prize_claim, $this->decimals);
    }

    public function getFormattedUsdtBalanceAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->usdt_balance, $this->decimals);
    }

    public function getMspcTotalPrizesAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->prizeReward()
                    ->orWhere(fn ($query) => $query->bonusReward());
            })->sum('mspc');
    }

    public function getMspcTotalBuyInAttribute(): int
    {
        return (int) $this->transactions()
            ->where(function ($query) {
                $query->purchaseTicket()
                    ->orWhere(fn ($query) => $query->purchaseNft());
            })->sum('mspc');
    }

    public function getMspcProfitLossAttribute(): int
    {
        return (int) $this->mspc_total_prizes - $this->mspc_total_buy_in;
    }

    public function getFormattedMspcTotalPrizesAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_total_prizes, $this->decimals);
    }

    public function getFormattedMspcTotalBuyInAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_total_buy_in, $this->decimals);
    }

    public function getFormattedMspcProfitLossAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_profit_loss, $this->decimals);
    }

    public function getFormattedMspcTotalPurchaseAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_total_purchase, $this->decimals);
    }

    public function getFormattedMspcTotalPrizeClaimAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_total_prize_claim, $this->decimals);
    }

    public function getFormattedMspcBalanceAttribute(): string
    {
        return (new Price())->getPriceInDecimals($this->mspc_balance, $this->decimals);
    }
}
