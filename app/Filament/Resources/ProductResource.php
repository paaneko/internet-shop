<?php

namespace App\Filament\Resources;

use App\Enums\Product\Status;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicAttribute;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 0;

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
                                                    ->getOptionLabelFromRecordUsing(
                                                        fn (Category $record
                                                        ) => $record->name_with_parent
                                                    )
                                                    ->preload()
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
                                                Forms\Components\Select::make(
                                                    'productRecommendations'
                                                )
                                                    ->relationship(
                                                        'productRecommendations',
                                                        'name',
                                                        fn (
                                                            Builder $query,
                                                            Product $record
                                                        ) => $query->whereNotIn(
                                                            'id',
                                                            [$record->id]
                                                        )

                                                    )
                                                    ->label(
                                                        'Product Recommendations'
                                                    )
                                                    ->multiple()
                                                    ->searchable()
                                                    ->preload()
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
                        Forms\Components\Tabs\Tab::make('Characteristics')
                            ->schema([
                                Forms\Components\Repeater::make(
                                    'productCharacteristics'
                                )
                                    ->relationship()
                                    ->itemLabel(
                                        function (array $state): string {
                                            return self::getCharacteristicLabel(
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
                                                fn (Forms\Set $set) => $set(
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
                                                'productAttributes',
                                                'name'
                                            )
                                            ->options(
                                                fn (Forms\Get $get
                                                ): Collection => CharacteristicAttribute::query(
                                                )->where(
                                                    'characteristic_id',
                                                    $get('characteristic_id')
                                                )->pluck('name', 'id')
                                            )
                                            ->live()
                                            ->multiple()
                                            ->preload()
                                            ->native(false),
                                    ])
                                    ->maxItems(
                                        fn () => Characteristic::count()
                                    )
                                    ->collapsible()
                                    ->columns(2)
                                    ->defaultItems(0)
                                    ->orderColumn('sorting_order')
                                    ->reorderableWithButtons(),
                            ]),
                        Forms\Components\Tabs\Tab::make('FAQ')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Repeater::make('faqs')
                                            ->relationship()
                                            ->hiddenLabel()
                                            ->itemLabel(
                                                fn (array $state
                                                ): string => $state['question']
                                                    ?? ''
                                            )
                                            ->schema([
                                                Forms\Components\TextInput::make(
                                                    'question'
                                                )
                                                    ->required(),
                                                Forms\Components\Textarea::make(
                                                    'answer'
                                                )
                                                    ->required(),
                                            ])
                                            ->defaultItems(0)
                                            ->cloneable()
                                            ->columns(2)
                                            ->collapsible()
                                            ->collapsed()
                                            ->reorderableWithButtons()
                                            ->orderColumn('sorting_order'),
                                    ]),

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
                    ->money('USD')
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

    private static function getCharacteristicLabel(?int $id): string
    {
        $characteristic
            = Characteristic::with(
                'characteristicGroup'
            )->find($id);

        if (! $characteristic) {
            return '';
        }

        return $characteristic->characteristicGroup->name
            .' > '.$characteristic->name;
    }
}
