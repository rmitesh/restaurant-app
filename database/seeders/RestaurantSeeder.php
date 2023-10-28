<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = \App\Models\Restaurant::factory(20)->create();

        foreach ($restaurants as $restaurant) {
            $restaurant->users()->sync(
                \App\Models\Restaurant::all('id')->random()
            );
        }
    }
}
