<?php

namespace App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;

use App\Filament\Restaurant\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodCategory extends CreateRecord
{
    protected static string $resource = FoodCategoryResource::class;
}
