<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\VariationsRelationManager;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

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
                                        Forms\Components\Section::make(
                                            'Associations'
                                        )
                                            ->schema([
                                                Forms\Components\TextInput::make(
                                                    'name'
                                                )
                                                    ->required()
                                                    ->maxLength(255),
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
                                                        'id',
                                                        fn (
                                                            Builder $query,
                                                            ?Product $record
                                                        ) => $query->where(
                                                            'id',
                                                            '!=',
                                                            $record->id ?? null
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
                                    ])
                                    ->columnSpan(['lg' => 1]),
                            ])
                            ->columns(1),
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
                Tables\Columns\TextColumn::make('id')
                    ->label('Id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
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
            VariationsRelationManager::make(),
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
