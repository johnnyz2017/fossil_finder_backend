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
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
        ];
    }

    // $table->id();
    // $table->bigInteger('parent_id')->unsigned()->default(0); // 0 stands for no parent
    // $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
    // $table->string('name');
    // $table->string('description');
    // $table->timestamps();
}
