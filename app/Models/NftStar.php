<?php

namespace App\Models;

use App\Models\Nft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NftStar extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'nft_stars';

    protected $fillable = [
        'quantity'
    ];

    // relations
    public function nft()
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }
}
