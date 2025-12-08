<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapturedPokemon extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'sprite',
        'api_id',
    ];
}
