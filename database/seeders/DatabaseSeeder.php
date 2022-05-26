<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Database\Seeders\TierSeeder;
use Database\Seeders\CountrySeeder;
use App\Support\Services\UserService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            TierSeeder::class
        ]);
    }
}
