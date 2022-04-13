<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(asset('assets/countries.csv'), 'r');
        $first_line = true;

        while ($line = fgetcsv($file)) {

            if ($first_line) {
                $first_line = false;
                continue;
            }

            Country::updateOrCreate([
                'code' => $line[1]
            ], [
                'name' => $line[0],
                'personal_id_type' => $line[2]
            ]);
        }
    }
}
