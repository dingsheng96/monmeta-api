<?php

namespace App\Models;

use App\Models\Nft;
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
        'email', 'nationality_id', 'contact_no'
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
    public function getTotalPrizesAttribute()
    {
        $transactions = $this->transactions()
            ->where(function ($query) {
                $query->prizeReward()
                    ->orWhere(fn ($query) => $query->bonusReward());
            })->get();

        $total = 0;

        foreach ($transactions as $transaction) {
            $total += $transaction->formatted_amount;
        }

        return $total;
    }

    public function getTotalBuyInAttribute()
    {
        $transactions = $this->transactions()
            ->where(function ($query) {
                $query->purchaseTicket()
                    ->orWhere(fn ($query) => $query->purchaseNft());
            })->get();

        $total = 0;

        foreach ($transactions as $transaction) {
            $total += $transaction->formatted_amount;
        }

        return $total;
    }

    public function getProfitLossAttribute()
    {
        return $this->total_prizes - $this->total_buy_in;
    }
}
