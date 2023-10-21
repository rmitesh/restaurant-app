<?php

namespace App\Filament\Restaurant\Resources;

use App\Filament\Restaurant\Resources\FoodCategoryResource\Pages;
use App\Filament\Restaurant\Resources\FoodCategoryResource\RelationManagers;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodCategoryResource extends Resource
{
    protected static ?string $model = FoodCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->placeholder('Category Name')
                    ->required(),

                Forms\Components\Toggle::make('status'),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('food-categories' . DIRECTORY_SEPARATOR . Restaurant::getTenantId())
                    ->preserveFilenames()
                    ->columnSpan('full')
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->defaultImageUrl(url('img/default-placeholder.png'))
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('status')
                    ->updateStateUsing(function (Model $record, $state) {
                        $record->update([
                            'status' => $state,
                        ]);

                        Notification::make()
                            ->title('Status has been updated.')
                            ->success()
                            ->send();
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('dS F Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFoodCategories::route('/'),
            'create' => Pages\CreateFoodCategory::route('/create'),
            'edit' => Pages\EditFoodCategory::route('/{record}/edit'),
        ];
    }    
}
