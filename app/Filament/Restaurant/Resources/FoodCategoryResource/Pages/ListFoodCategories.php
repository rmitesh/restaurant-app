<?php

namespace App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;

use App\Filament\Restaurant\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoodCategories extends ListRecords
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
