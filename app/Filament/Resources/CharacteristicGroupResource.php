<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CharacteristicGroupResource\Pages;
use App\Models\CharacteristicGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CharacteristicGroupResource extends Resource
{
    protected static ?string $model = CharacteristicGroup::class;

    protected static ?string $slug = 'shop/characteristic-group';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Characteristic Groups';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationParentItem = 'Characteristics';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sorting_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sorting_order')
                    ->label('Sorting Order')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCharacteristicGroups::route('/'),
            'create' => Pages\CreateCharacteristicGroup::route('/create'),
            'edit' => Pages\EditCharacteristicGroup::route('/{record}/edit'),
        ];
    }
}
