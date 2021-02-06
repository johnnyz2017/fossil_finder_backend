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
    }
}
