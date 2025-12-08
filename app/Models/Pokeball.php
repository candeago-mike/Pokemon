<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokeball extends Model
{
    protected $fillable = ['name', 'bonus'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pokeballs')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
