<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => User::ROLE_SUPER_ADMIN,
        ]);

        // Admin
        $user = User::factory()->create([
            'name' => 'Restaurant Admin',
            'email' => 'restaurant@app.com',
        ]);

        $user->assignRole($role);

        $role = Role::create([
            'name' => User::ROLE_RESTAURANT_OWNER,
        ]);

        \App\Models\User::factory(10)->create()
            ->each->assignRole($role);

        $this->call([
            RestaurantSeeder::class,
            FoodCategorySeeder::class,
            FoodItemSeeder::class,
        ]);
    }
}
