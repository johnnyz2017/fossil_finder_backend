<?php

namespace Database\Seeders;
// namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(PostFactory::class, 10)->create(); //OLD way
        Post::factory(20)->create();
    }
}
