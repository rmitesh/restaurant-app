<?php

namespace App\Filament\Restaurant\Resources\FoodItemResource\Pages;

use App\Filament\Restaurant\Resources\FoodItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodItem extends CreateRecord
{
    protected static string $resource = FoodItemResource::class;
}
