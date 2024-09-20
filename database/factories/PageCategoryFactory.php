<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PageCategory;

class PageCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(3),
            'description' => $this->faker->text(150),
            'published_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
