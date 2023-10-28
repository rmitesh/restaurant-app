<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->word()) . ' Restaurant',
            'address' => fake()->address(),
            'area' => fake()->streetName(),
            'latitude' => fake()->latitude($min = -90, $max = 90),
            'longitude' => fake()->longitude($min = -180, $max = 180),
            
            'is_featured' => fake()->boolean(),

            'logo' => fake()->imageUrl(640, 480, 'animals', true),
            'fssai_number' => fake()->numberBetween(11111111111111, 99999999999999),
            'phone_number' => (int) fake()->phoneNumber(),
            'status' => fake()->boolean(),
        ];
    }
}
