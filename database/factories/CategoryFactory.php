<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'parent_id' => \App\Models\Category::all()->empty() ? 0 : \App\Models\Category::inRandomOrder()->first()->id,
            // 'parent_id' => \App\Models\Category::all()->empty() ? 0 : \App\Models\Category::all()->shuffle()->first()->id,
            'parent_id' => $this->faker->numberBetween(0, 10),
            // 'name' => Str::random(10),
            // 'description' => Str::random(30)
            'title' => 'Category '.$this->faker->word(),
            // 'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
            'description' => $this->faker->text(50)
        ];
    }
}
