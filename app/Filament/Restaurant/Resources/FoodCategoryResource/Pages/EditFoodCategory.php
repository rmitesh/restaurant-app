<?php

namespace App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;

use App\Filament\Restaurant\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoodCategory extends EditRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
