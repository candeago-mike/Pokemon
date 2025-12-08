<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokeballSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    \App\Models\Pokeball::insert([
        ['name' => 'Pokéball',  'bonus' => 1.3],
        ['name' => 'Superball', 'bonus' => 2.5],
        ['name' => 'Hyperball', 'bonus' => 4.5],
        ['name' => 'Masterball','bonus' => 255], // capture garantie
    ]);
}

}
