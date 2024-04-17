<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Filament\Shared\ProductResource\GetCharacteristicLabel;
use App\Models\CharacteristicAttribute;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class VariationsRelationManager extends RelationManager
{
    use GetCharacteristicLabel;

    protected static string $relationship = 'variations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Main')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\Select::make(
                                                    'product_id'
                                                )
                                                    ->required()
                                                    ->searchable()
                                                    ->relationship(
                                                        'product',
                                                        'name'
                                                    ),
                                                Forms\Components\TextInput::make(
                                                    'name'
                                                )
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\ColorPicker::make(
                                                    'color'
                                                )
                                                    ->required(),
                                                Forms\Components\TextInput::make(
                                                    'slug'
                                                )
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->columns(2),
                                        Forms\Components\Section::make('Seo')
                                            ->schema([
                                                Forms\Components\TextInput::make(
                                                    'meta_tag_h1'
                                                )
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'meta_tag_title'
                                                )
                                                    ->maxLength(255),
                                                Forms\Components\Textarea::make(
                                                    'meta_tag_description'
                                                ),
                                                Forms\Components\MarkdownEditor::make(
                                                    'description'
                                                ),
                                            ]),
                                        Forms\Components\Section::make(
                                            'Main Photo'
                                        )
                                            ->schema([
                                                Forms\Components\SpatieMediaLibraryFileUpload::make(
                                                    'productImages'
                                                )
                                                    ->multiple()
                                                    ->reorderable()
                                                    ->disk('media-product'),
                                            ]),
                                        Forms\Components\Section::make('Scus')
                                            ->schema([
                                                Forms\Components\TextInput::make(
                                                    'product_code'
                                                )
                                                    ->required()
                                                    ->label('Product Code')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'sku'
                                                )
                                                    ->required()
                                                    ->label('SKU')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'upc'
                                                )
                                                    ->required()
                                                    ->label('UPC')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'ean'
                                                )
                                                    ->required()
                                                    ->label('EAN')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'jan'
                                                )
                                                    ->required()
                                                    ->label('JAN')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make(
                                                    'mpn'
                                                )
                                                    ->required()
                                                    ->label('MPN')
                                                    ->maxLength(255),
                                            ])
                                            ->columns(2),
                                        Forms\Components\Section::make(
                                            'Price & Quantity'
                                        )
                                            ->schema([
                                                Forms\Components\TextInput::make(
                                                    'price'
                                                )
                                                    ->required()
                                                    ->numeric()
                                                    ->default(0)
                                                    ->prefix('$'),
                                                Forms\Components\TextInput::make(
                                                    'count'
                                                )
                                                    ->required()
                                                    ->numeric()
                                                    ->default(0),
                                            ])
                                            ->columns(2),
                                        Forms\Components\Repeater::make(
                                            'variationCharacteristics'
                                        )
                                            ->relationship()
                                            ->itemLabel(
                                                function (array $state
                                                ): string {
                                                    return $this->getCharacteristicLabel(
                                                        $state['characteristic_id']
                                                    );
                                                }
                                            )
                                            ->schema([
                                                Forms\Components\Select::make(
                                                    'characteristic_id'
                                                )
                                                    ->required()
                                                    ->relationship(
                                                        'characteristic',
                                                        'name'
                                                    )
                                                    ->afterStateUpdated(
                                                        fn (Forms\Set $set
                                                        ) => $set(
                                                            'characteristic_attribute_id',
                                                            null
                                                        )
                                                    )
                                                    ->searchable()
                                                    ->preload()
                                                    ->live()
                                                    ->native(false),
                                                Forms\Components\Select::make(
                                                    'characteristic_attribute_id'
                                                )
                                                    ->required()
                                                    ->relationship(
                                                        'variationAttributes',
                                                        'name'
                                                    )
                                                    ->options(
                                                        fn (Forms\Get $get
                                                        ): Collection => CharacteristicAttribute::query(
                                                        )->where(
                                                            'characteristic_id',
                                                            $get(
                                                                'characteristic_id'
                                                            )
                                                        )->pluck('name', 'id')
                                                    )
                                                    ->live()
                                                    ->multiple()
                                                    ->preload()
                                                    ->native(false),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU'),
                Tables\Columns\ColorColumn::make('color')
                    ->label('Color'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('count')
                    ->label('Quantity')
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('indexation')
                    ->label('Indexation')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
