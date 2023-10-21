<?php

namespace App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;

use App\Filament\Restaurant\Resources\FoodCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateFoodCategory extends CreateRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = Str::slug($data['name']);
        return static::getModel()::create($data);
    }
}
