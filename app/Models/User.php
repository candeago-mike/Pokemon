<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pokeballs()
{
    return $this->belongsToMany(Pokeball::class, 'user_pokeballs')
                ->withPivot('quantity')
                ->withTimestamps();
}

public function items()
{
    return $this->belongsToMany(ShopItem::class)->withPivot('quantity')->withTimestamps();
}


public function addItem(ShopItem $item, $amount = 1)
{
    $current = $this->items()->where('shop_item_id', $item->id)->first();

    if ($current) {
        // Incrémente la quantité
        $this->items()->updateExistingPivot($item->id, [
            'quantity' => $current->pivot->quantity + $amount
        ]);
    } else {
        // Crée l'entrée dans le pivot
        $this->items()->attach($item->id, ['quantity' => $amount]);
    }
}

   protected static function booted()
    {
        static::created(function ($user) {
            $pokeball = Pokeball::where('name', 'Pokéball')->first();

            if ($pokeball) {
                $user->pokeballs()->attach($pokeball->id, ['quantity' => 20]);
            }
        });
    }
}
