<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddDailyCoins extends Command
{
    protected $signature = 'coins:add-daily';
    protected $description = 'Ajoute 25 pièces à tous les utilisateurs chaque jour';

    public function handle(): int
    {
        User::query()->increment('coins', 25); // ajoute 25 à la colonne coins
        return Command::SUCCESS;
    }
}
