<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use \App\Models\User;
use \App\Models\Post;
use \App\Models\Category;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = collect(User::all()->modelKeys());
        $posts = collect(Post::all()->modelKeys());
        $categories = collect(Category::all()->modelKeys());
        $word = $this->faker->word();

        return [
            'user_id' => $users->random(),
            'post_id' => $posts->random(),
            'title' => 'Comment Title '.$word,
            'content' => 'Conent of Comment '.$word,
            'category_id' => $categories->random()
        ];
    }
}
