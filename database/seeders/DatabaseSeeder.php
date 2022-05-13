<?php

namespace Database\Seeders;

use App\Models\Nft;
use App\Helpers\Moralis;
use Illuminate\Database\Seeder;
use Database\Seeders\TierSeeder;
use Database\Seeders\CountrySeeder;

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

        // if (!app()->isProduction() && $this->command->confirm('Do you want to create demo data', false)) {
        //     User::factory()
        //         ->count((int) $this->command->ask('How many users do you want to create?'))
        //         ->create();
        // }

        // Nft::with('user')
        //     ->active()
        //     ->has('user')
        //     ->get()
        //     ->each(function ($nft) {

        //         $nftDetail = (new Moralis())->getUserNftDetails($nft->user->wallet_id, $nft->token_id);

        //         if (!empty($nftDetail)) {
        //             $metaData = json_decode($nftDetail['metadata']);

        //             $nft->image = $metaData->image;
        //             $nft->properties = $metaData;

        //             if ($nft->isDirty()) {
        //                 $nft->save();
        //             }
        //         }
        //     });
    }
}
