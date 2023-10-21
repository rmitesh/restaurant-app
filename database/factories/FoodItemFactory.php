<?php

namespace Database\Factories;

use App\Models\FoodCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodItem>
 */
class FoodItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        $foodName = $faker->foodName();

        return [
            'food_category_id' => FoodCategory::all('id')->random()->id,
            'name' => $foodName,
            'slug' => Str::slug($foodName),
            'description' => fake()->sentence(),
            'is_best_seller' => fake()->boolean(),
            'is_vegetarian' => fake()->boolean(),
            'price' => fake()->randomFloat(2, 10, 500),
            'status' => fake()->boolean(),
        ];
    }
}
