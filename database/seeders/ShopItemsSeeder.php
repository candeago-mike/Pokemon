<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    DB::table('shop_items')->insert([
        ['name' => 'Pokéball', 'price' => 5, 'type' => 'pokeball'],
        ['name' => 'Superball', 'price' => 25, 'type' => 'superball'],
        ['name' => 'Hyperball', 'price' => 50, 'type' => 'hyperball'],
        ['name' => 'Masterball', 'price' => 100, 'type' => 'masterball'],
    ]);
}

}
