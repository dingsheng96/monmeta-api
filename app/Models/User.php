<?php

namespace App\Models;

use App\Models\Nft;
use App\Models\Country;
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
        'email', 'nationality', 'contact_no'
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
        return $this->belongsTo(Country::class, 'nationality', 'id');
    }

    public function nfts()
    {
        return $this->hasMany(Nft::class, 'nft_id', 'id');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'sourceable');
    }
}
