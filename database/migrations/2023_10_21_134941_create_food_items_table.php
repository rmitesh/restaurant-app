<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->integer('food_category_id')->unsigned();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('description', 191);
            $table->string('image', 100)->nullable();
            $table->boolean('is_best_seller')->default(false)->comment('0 - No, 1 - Yes');
            $table->boolean('is_vegetarian')->default(true)->comment('0 - Non-Veg, 1 - Veg');
            $table->double('price', 5, 2)->default(0.00);
            $table->boolean('status')->default(false)->comment('0 - InActive, 1 - Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
