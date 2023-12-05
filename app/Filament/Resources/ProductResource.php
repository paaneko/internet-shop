<?php

namespace App\Filament\Resources;

use App\Enums\Product\Status;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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
                                                Forms\Components\TextInput::make(
                                                    'name'
                                                )
                                                    ->required()
                                                    ->maxLength(255),
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
                                    ])
                                    ->columnSpan(['lg' => 2]),

                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Section::make('Status')
                                            ->schema([
                                                Forms\Components\Radio::make(
                                                    'status'
                                                )
                                                    ->required()
                                                    ->options(Status::class)
                                                    ->default('out-of-stock'),
                                            ]),
                                        Forms\Components\Section::make(
                                            'Associations'
                                        )
                                            ->schema([
                                                Forms\Components\Select::make(
                                                    'categories'
                                                )
                                                    ->nullable()
                                                    ->multiple()
                                                    ->relationship(
                                                        'categories',
                                                        'name'
                                                    )
                                                    ->native(false),
                                                Forms\Components\Select::make(
                                                    'brand_id'
                                                )
                                                    ->nullable()
                                                    ->relationship(
                                                        'brand',
                                                        'name'
                                                    )
                                                    ->native(false),
                                            ]),
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\Placeholder::make(
                                                    'created_at'
                                                ),
                                                Forms\Components\Placeholder::make(
                                                    'updated_at'
                                                ),
                                            ])
                                            ->hiddenOn('create'),
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\Toggle::make(
                                                    'indexation'
                                                )
                                                    ->default(true),
                                            ]),
                                    ])
                                    ->columnSpan(['lg' => 1]),
                            ])
                            ->columns(3),

                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                /*
                                 * TODO create Photo Gallery logic
                                 * 1) adding multiple images
                                 * 2) photo order directions
                                 */
                                Forms\Components\Section::make('Photo Gallery')
                                    ->schema([
                                        Forms\Components\FileUpload::make(
                                            'image_url'
                                        )
                                            ->hiddenLabel()
                                            ->image(),
                                    ])
                                    ->collapsible(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Info')
                            ->schema([
                                Forms\Components\Section::make('Scus')
                                    ->schema([
                                        Forms\Components\TextInput::make(
                                            'product_code'
                                        )
                                            ->label('Product Code')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('SKU')
                                            ->label('SKU')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('UPC')
                                            ->label('UPC')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('EAN')
                                            ->label('EAN')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('JAN')
                                            ->label('JAN')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('MPN')
                                            ->label('MPN')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                                Forms\Components\Section::make(
                                    'Price & Quantity'
                                )
                                    ->schema([
                                        /*
                                         * TODO create cast for money conversion
                                         */
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
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
