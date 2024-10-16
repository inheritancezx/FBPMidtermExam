<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray(); // Get an array of category IDs
        $courses = Course::pluck('id')->toArray(); // Get an array of course IDs

        return [
            'name' => fake()->sentence(rand(2,3), false),
            'course_id' => fake()->randomElement($courses),
            'category_id' => fake()->randomElement($categories),
            'slug' => Str::slug(fake()->sentence(rand(2,3), false)),
            // 'image' => fake()->image(null, 270, 225, 'foods', true),
            'image' => 'https://picsum.photos/279/225?food',
            'likes' => fake()->randomNumber(3, false),
            'est_price' => fake()->numerify('##,000'),
            'content' => fake()->text(),
        ];
    }
}
