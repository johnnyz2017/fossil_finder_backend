<?php

namespace Database\Seeders;

use App\Models\FStage;
use Illuminate\Database\Seeder;

class FStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FStage::create([
            'id' => 1,
            'series_id' => 1,
            'name' => 'Meghalayan'
        ]);
        FStage::create([
            'id' => 2,
            'series_id' => 1,
            'name' => 'Northgrippian'
        ]);
        FStage::create([
            'id' => 3,
            'series_id' => 1,
            'name' => 'Greenlandian'
        ]);

        FStage::create([
            'id' => 4,
            'series_id' => 2,
            'name' => 'Upper'
        ]);
        FStage::create([
            'id' => 5,
            'series_id' => 2,
            'name' => 'Chibanian'
        ]);
        FStage::create([
            'id' => 6,
            'series_id' => 2,
            'name' => 'Calabrian'
        ]);
        FStage::create([
            'id' => 7,
            'series_id' => 2,
            'name' => 'Gelasian'
        ]);

        FStage::create([
            'id' => 8,
            'series_id' => 3,
            'name' => 'Piacenzian'
        ]);
        FStage::create([
            'id' => 9,
            'series_id' => 3,
            'name' => 'Zanclean'
        ]);
    }
}
