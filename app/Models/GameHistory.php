<?php

namespace App\Models;

use App\Models\User;
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

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
