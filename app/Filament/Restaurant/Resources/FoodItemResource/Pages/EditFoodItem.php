<?php

namespace App\Filament\Restaurant\Resources\FoodItemResource\Pages;

use App\Filament\Restaurant\Resources\FoodItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoodItem extends EditRecord
{
    protected static string $resource = FoodItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
