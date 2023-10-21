<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodCategory>
 */
class FoodCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $word = ucwords(fake()->word());
        return [
            'restaurant_id' => Restaurant::all('id')->random()->id,
            'name' => $word,
            'slug' => Str::slug($word),
            'status' => fake()->boolean(),
        ];
    }
}
