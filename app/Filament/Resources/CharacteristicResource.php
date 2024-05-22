<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CharacteristicResource\Pages;
use App\Models\Characteristic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CharacteristicResource extends Resource
{
    protected static ?string $model = Characteristic::class;

    protected static ?string $slug = 'shop/characteristic';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = 'Characteristics';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make(
                                            'hint_text'
                                        ),
                                    ]),
                                Forms\Components\Section::make('Attributes')
                                    ->schema([
                                        Forms\Components\Repeater::make(
                                            'attributes'
                                        )
                                            ->relationship()
                                            ->simple(
                                                Forms\Components\TextInput::make(
                                                    'name'
                                                )
                                                    ->required()
                                                    ->maxLength(255),
                                            )
                                            ->orderColumn('sorting_order')
                                            ->reorderableWithButtons(),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 2]),

                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Associations')
                                    ->schema([
                                        Forms\Components\Select::make(
                                            'characteristic_group_id'
                                        )
                                            ->required()
                                            ->relationship(
                                                'characteristicGroup',
                                                'name'
                                            )
                                            ->searchable()
                                            ->preload()
                                            ->native(false),
                                    ]),
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Toggle::make(
                                            'is_collapsed'
                                        )
                                            ->default(false),
                                    ]),
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make(
                                            'sorting_order'
                                        )
                                            ->required()
                                            ->numeric()
                                            ->default(0),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('characteristicGroup.name')
                    ->searchable()
                    ->sortable()
                    ->label('Characteristic Group'),
                Tables\Columns\TextColumn::make('sorting_order')
                    ->label('Sorting Order')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('is_collapsed')
                    ->label('Is Collapsed')
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
            'index' => Pages\ListCharacteristics::route('/'),
            'create' => Pages\CreateCharacteristic::route('/create'),
            'edit' => Pages\EditCharacteristic::route('/{record}/edit'),
        ];
    }
}
