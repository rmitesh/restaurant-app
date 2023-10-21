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
            'user_id' => User::all('id')->random()->id,
            'name' => ucwords(fake()->word()) . ' Restaurant',
            'logo' => fake()->imageUrl(640, 480, 'animals', true),
            'fssai_number' => fake()->numberBetween(11111111111111, 99999999999999),
            'phone_number' => (int) fake()->phoneNumber(),
            'status' => fake()->boolean(),
        ];
    }
}
