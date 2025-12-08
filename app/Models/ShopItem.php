<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
    ];



    public function users()
{
    return $this->belongsToMany(User::class, 'user_pokeballs')
        ->withPivot('quantity')
        ->withTimestamps();
}

}
