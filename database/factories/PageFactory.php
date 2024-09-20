<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\PageCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(80),
            'keywords' => fake()->text(70),
            'content' => fake()->text(500),
            'description' => fake()->text(120),
            'slug' => fake()->slug(8),
            'featured_image' => "7clAggheaalWSNe0sI0cwLUE4ZvYp3qJrBdqnN1B.png",
            'category_id' => PageCategory::factory()
        ];
    }
}
