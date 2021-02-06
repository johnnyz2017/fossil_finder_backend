<?php

namespace Database\Seeders;

use App\Models\FSeries;
use Illuminate\Database\Seeder;

class FSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FSeries::create([
            'id' => 1,
            'system_id' => 1,
            'name' => 'Holocene'
        ]);
        FSeries::create([
            'id' => 2,
            'system_id' => 1,
            'name' => 'Pleistocene'
        ]);

        FSeries::create([
            'id' => 3,
            'system_id' => 2,
            'name' => 'Pliocene'
        ]);
        FSeries::create([
            'id' => 4,
            'system_id' => 2,
            'name' => 'Miocene'
        ]);

        FSeries::create([
            'id' => 5,
            'system_id' => 3,
            'name' => 'Oligocene'
        ]);
        FSeries::create([
            'id' => 6,
            'system_id' => 3,
            'name' => 'Eocene'
        ]);

        FSeries::create([
            'id' => 7,
            'system_id' => 4,
            'name' => 'Paleocene'
        ]);
        FSeries::create([
            'id' => 8,
            'system_id' => 4,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 9,
            'system_id' => 4,
            'name' => 'Lower'
        ]);
    }
}
