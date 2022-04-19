<?php

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    protected $tiers = [
        'Spaceflight Participant',
        'Technical Operator',
        'Flight Engineer',
        'Scienctist Cosmonaut',
        'Pilot Cosmonaut',
        'Commander',
        'The Administrator'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stars_required = 0;

        foreach ($this->tiers as $tierName) {

            Tier::updateOrCreate(
                ['name' => $tierName],
                ['stars_required' => $stars_required]
            );

            $stars_required += 5;
        }
    }
}
