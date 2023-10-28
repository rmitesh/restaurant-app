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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('area', 50);
            $table->string('landmarks', 50)->nullable();

            $table->double('latitude', 15, 8)->nullable();
            $table->double('longitude', 15, 8)->nullable();

            $table->boolean('is_featured')->default(false);
            
            $table->string('logo', 100);
            $table->string('fssai_number', 50)->nullable();
            $table->string('phone_number', 15);
            $table->boolean('status')->default(false)->comment('0 - InActive, 1 - Active');
            $table->timestamps();
        });

        Schema::create('restaurant_user', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_user');
        Schema::dropIfExists('restaurants');
    }
};
