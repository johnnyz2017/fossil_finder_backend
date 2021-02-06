<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Post;
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

        $this->call(FSystemSeeder::class);
        $this->call(FSeriesSeeder::class);
        $this->call(FStageSeeder::class);

        Category::factory(10)->create();
        Post::factory(20)->create();
        Comment::factory(30)->create();

    }
}
