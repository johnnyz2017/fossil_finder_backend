<?php

namespace Database\Seeders;

use App\Models\User;

use App\Models\Role;
use App\Models\Permission;
// use LaratrustSeeder;
// use Database\Seeders\LaratrustSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        $this->call(LaratrustSeeder::class);
    }
}
