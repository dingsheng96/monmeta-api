<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory,
        SoftDeletes;


    protected $table = 'countries';

    protected $fillable = [
        'name', 'code', 'personal_id_type'
    ];

    const ID_TYPE_PASSPORT = 'passport';
    const ID_TYPE_MYKAD = 'mykad';

    public function users()
    {
        return $this->hasMany(User::class, 'nationality', 'id');
    }
}
