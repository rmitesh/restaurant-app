<?php

namespace App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;

use App\Filament\Restaurant\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditFoodCategory extends EditRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['slug'] = Str::slug($data['name']);
     
        $record->update($data);
 
        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
