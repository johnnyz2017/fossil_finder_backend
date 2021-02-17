<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FSystem;

class FSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FSystem::create([
            'id' => 1,
            'name' => 'Quaternary'
        ]);
        FSystem::create([
            'id' => 2,
            'name' => 'Neogene'
        ]);
        FSystem::create([
            'id' => 3,
            'name' => 'Paleogene'
        ]);
        FSystem::create([
            'id' => 4,
            'name' => 'Cretaceous'
        ]);
        FSystem::create([
            'id' => 5,
            'name' => 'Jurassic'
        ]);
        FSystem::create([
            'id' => 6,
            'name' => 'Triassic'
        ]);
        FSystem::create([
            'id' => 7,
            'name' => 'Permian'
        ]);
        //Carboniferous/Pennsylvanian
        FSystem::create([
            'id' => 8,
            'name' => 'Carboniferous/Pennsylvanian'
        ]);
        FSystem::create([
            'id' => 9,
            'name' => 'Devonian'
        ]);
        FSystem::create([
            'id' => 10,
            'name' => 'Silurian'
        ]);
        FSystem::create([
            'id' => 11,
            'name' => 'Ordovician'
        ]);
        FSystem::create([
            'id' => 12,
            'name' => 'Cambrian'
        ]);
        FSystem::create([
            'id' => 13,
            'name' => 'Ediacaran'
        ]);
        FSystem::create([
            'id' => 14,
            'name' => 'Cryogenian'
        ]);
        FSystem::create([
            'id' => 15,
            'name' => 'Tonian'
        ]);
        FSystem::create([
            'id' => 16,
            'name' => 'Stenian'
        ]);
        FSystem::create([
            'id' => 17,
            'name' => 'Ectasian'
        ]);
        FSystem::create([
            'id' => 18,
            'name' => 'Calymmian'
        ]);
        FSystem::create([
            'id' => 19,
            'name' => 'Statherian'
        ]);
        FSystem::create([
            'id' => 20,
            'name' => 'Orosirian'
        ]);
        FSystem::create([
            'id' => 21,
            'name' => 'Rhyacian'
        ]);
        FSystem::create([
            'id' => 22,
            'name' => 'Sideria'
        ]);
        FSystem::create([
            'id' => 23,
            'name' => 'Hadean'
        ]);
        FSystem::create([
            'id' => 24,
            'name' => 'Anthropocene'
        ]);
    }
}
