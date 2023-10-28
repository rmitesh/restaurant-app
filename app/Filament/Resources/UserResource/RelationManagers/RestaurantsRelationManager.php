<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestaurantsRelationManager extends RelationManager
{
    protected static string $relationship = 'restaurants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->placeholder('Restaurant Name')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->placeholder('Phone Number')
                    ->maxLength(15)
                    ->required(),

                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('restaurant-logos')
                    ->preserveFilenames()
                    ->columnSpan('full')
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('fssai_number')
                    ->placeholder('FSSAI Number')
                    ->maxLength(50),

                Forms\Components\Toggle::make('status'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->rounded()
                    ->defaultImageUrl(url('/img/default-placeholder.png')),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
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
}
