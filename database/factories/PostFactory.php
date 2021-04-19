<?php

namespace Database\Factories;

use App\Models\Category;
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
        $users = collect(User::all()->modelKeys());
        $categories = collect(Category::all()->modelKeys());

        $img_list = array("http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg", "images/others/hs001.jpeg","images/others/hs002.jpeg","images/others/hs003.jpeg");
        shuffle($img_list);
        // $word = $this->faker->word();
        $word = $this->faker->text(50);
        return [
            'user_id' => $users->random(),
            'auth_user_id' => 1,

            'temp_id' => $this->faker->uuid,
            'perm_id' => $this->faker->uuid,
            // 'temp_id' => $this->faker->numberBetween(10000, 11000),
            // 'perm_id' => $this->faker->numberBetween(20000, 21000),
            'address' => $this->faker->address,
            // 'title' => $this->faker->sentence(5),
            'title' => 'Title of'.$this->faker->word(),
            'content' => 'Content of '.$word,
            // 'content' => $this->faker->sentences(10),
            'category_id' => $categories->random(),
            'final_category_id' => $categories->random(),
            'final_category_id_from' => $users->random(),

            'private' => false,
            'published' => true,

            // 'images' => shuffle($img_list) > 0 ? $img_list : $img_list[random_int(0, 2)],
            // 'images' => $img_list[random_int(0, 2)],
            'images' => implode(',', $img_list),
            // 'images' => 'images/others/hs001.jpeg,images/others/hs002.jpeg,images/others/hs003.jpeg',
            // 'images' => String.join([',', [$this->faker->imageUrl()]]),
            'coordinate_longitude' => 121.26661838261842 + $this->faker->numberBetween(0, 100) / 10000.0,
            'coordinate_latitude' => 31.111403203411864 + $this->faker->numberBetween(0, 100) / 10000.0,
            // 'coordinate_longitude' => 121.26661838261842 + $this->faker->randomFloat(0.001, 0, 1.0),
            // 'coordinate_latitude' => 31.111403203411864 + $this->faker->randomFloat(0.001, 0, 1.0),
            // 'coordinate_altitude' => 500 + $this->faker->numberBetween(0, 100) / 1000.0
            'coordinate_altitude' => 500.001
        ];
    }
}
