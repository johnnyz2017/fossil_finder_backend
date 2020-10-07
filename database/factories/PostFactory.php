<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => \App\Models\User::inRandomOrder()->fist()->id,
            // 'user_id' => User::all()->inRandomOrder()->first()->id,
            'user_id' => User::all()->shuffle()->first()->id,
            'auth_user_id' => 1,
            'temp_id' => $this->faker->numberBetween(10000, 11000),
            'perm_id' => $this->faker->numberBetween(20000, 21000),
            'address' => $this->faker->address,
            // 'address' => $this->faker->streetAddress,
            // 'title' => $this->faker->sentence(5),
            'title' => 'Title ',
            'content' => 'Content ',
            // 'content' => $this->faker->sentences(10),
            // 'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'category_id' => \App\Models\Category::all()->shuffle()->first()->id,
            'final_category_id' => \App\Models\Category::all()->shuffle()->first()->id,
            'final_category_id_from' => User::all()->shuffle()->first()->id,
            // 'category_id' => 1,
            // 'final_category_id' => 1,
            // 'final_category_id_from' => 1,
            'images' => '',
            'coordinate_longitude' => $this->faker->numberBetween(120, 150),
            'coordinate_latitude' => $this->faker->numberBetween(30, 50),
            'coordinate_altitude' => $this->faker->numberBetween(320, 550),
        ];
    }

    // $table->bigInteger('user_id')->unsigned(); //发布用户
    // $table->foreign('user_id')->references('id')->on('users');
    // $table->bigInteger('auth_user_id')->unsigned(); //最后审核用户？
    // $table->integer('temp_id');
    // $table->integer('perm_id');
    // $table->string('title');
    // $table->longText('content');
    // $table->boolean('private')->unsigned()->default(false); //个人设置，是否私有
    // $table->boolean('published')->unsigned()->default(false); //管理员审核，是否可以发布
    // $table->longText('images'); //images url array
    // $table->integer('category_id')->unsigned(); //类别
    // $table->foreign('category_id')->references('id')->on('categories');
    // $table->integer('final_category_id')->unsigned(); //最终类别
    // $table->bigInteger('final_category_id_from')->unsigned(); //最终类别来自于，默认会是自己
    // $table->double('coordinate_longitude'); //经度
    // $table->double('coordinate_latitude'); //纬度
    // $table->double('coordinate_altitude'); //高度 海拔
    // $table->string('address');
}
