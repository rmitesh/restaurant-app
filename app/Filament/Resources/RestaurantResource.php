<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestaurantResource\Pages;
use App\Filament\Resources\RestaurantResource\RelationManagers;
use App\Models\Restaurant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestaurantResource extends Resource
{
    protected static ?string $model = Restaurant::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Owner Details')
                    ->relationship('user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->placeholder('Name')
                            ->autofocus()
                            ->maxLength(60)
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->placeholder('Email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(60)
                            ->required(),
                    ]),

                Forms\Components\Fieldset::make('Restaurant Details')
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

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Owner Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('dS F Y, H:i'),
            ])
            ->filters([
                //
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRestaurants::route('/'),
            'create' => Pages\CreateRestaurant::route('/create'),
            'edit' => Pages\EditRestaurant::route('/{record}/edit'),
        ];
    }    
}
