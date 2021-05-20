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

        FSeries::create([
            'id' => 10,
            'system_id' => 5,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 11,
            'system_id' => 5,
            'name' => 'Middle'
        ]);
        FSeries::create([
            'id' => 12,
            'system_id' => 5,
            'name' => 'Lower'
        ]);
        FSeries::create([
            'id' => 13,
            'system_id' => 6,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 14,
            'system_id' => 6,
            'name' => 'Middle'
        ]);
        FSeries::create([
            'id' => 15,
            'system_id' => 6,
            'name' => 'Lower'
        ]);
        FSeries::create([
            'id' => 16,
            'system_id' => 7,
            'name' => 'Lopingian'
        ]);
        FSeries::create([
            'id' => 17,
            'system_id' => 7,
            'name' => 'Guadalupian'
        ]);
        FSeries::create([
            'id' => 18,
            'system_id' => 7,
            'name' => 'Cisuralian'
        ]);
        FSeries::create([
            'id' => 19,
            'system_id' => 8,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 20,
            'system_id' => 8,
            'name' => 'Middle'
        ]);
        FSeries::create([
            'id' => 21,
            'system_id' => 8,
            'name' => 'Lower'
        ]);
        FSeries::create([
            'id' => 22,
            'system_id' => 9,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 23,
            'system_id' => 9,
            'name' => 'Middle'
        ]);

        FSeries::create([
            'id' => 24,
            'system_id' => 9,
            'name' => 'Lower'
        ]);
        FSeries::create([
            'id' => 25,
            'system_id' => 10,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 26,
            'system_id' => 10,
            'name' => 'Middle'
        ]);
        FSeries::create([
            'id' => 27,
            'system_id' => 10,
            'name' => 'Lower'
        ]);
        FSeries::create([
            'id' => 28,
            'system_id' => 11,
            'name' => 'Pridoli'
        ]);
        FSeries::create([
            'id' => 29,
            'system_id' => 11,
            'name' => 'Ludlow'
        ]);
        FSeries::create([
            'id' => 30,
            'system_id' => 11,
            'name' => 'Wenlock'
        ]);
        FSeries::create([
            'id' => 31,
            'system_id' => 11,
            'name' => 'Llandovery'
        ]);
        FSeries::create([
            'id' => 32,
            'system_id' => 12,
            'name' => 'Upper'
        ]);
        FSeries::create([
            'id' => 33,
            'system_id' => 12,
            'name' => 'Middle'
        ]);
        FSeries::create([
            'id' => 34,
            'system_id' => 12,
            'name' => 'Lower'
        ]);

        FSeries::create([
            'id' => 35,
            'system_id' => 13,
            'name' => 'Furongian'
        ]);

        FSeries::create([
            'id' => 36,
            'system_id' => 13,
            'name' => 'Miaolingian'
        ]);
        FSeries::create([
            'id' => 37,
            'system_id' => 13,
            'name' => 'Series 2'
        ]);
        FSeries::create([
            'id' => 38,
            'system_id' => 13,
            'name' => 'Terreneuvian'
        ]);
    }
}
