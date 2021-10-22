<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use CMS\Category\Models\Category;

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
            'name' => $this->faker->name(),
            'image' => $this->faker->image(public_path('frontend'),640,480, null, false),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'parent_id' => 0,
            'link'=>Str::slug($this->faker->name),
            'orders' =>1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [

            ];
        });
    }
}
