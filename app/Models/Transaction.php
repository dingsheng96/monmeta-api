<?php

namespace App\Models;

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
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    // relations
    public function sourceable()
    {
        return $this->morphTo();
    }
}
