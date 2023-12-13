<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

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
                                        Forms\Components\Section::make(
                                            'Associations'
                                        )
                                            ->schema([
                                                Forms\Components\Select::make(
                                                    'parent_id'
                                                )
                                                    ->relationship(
                                                        'parent',
                                                        'name',
                                                        fn (Builder $query
                                                        ) => $query->where(
                                                            'parent_id',
                                                            null
                                                        )
                                                    )
                                                    ->label('Parent Category')
                                                    ->searchable()
                                                    ->preload()
                                                    ->native(false),
                                                Forms\Components\Select::make(
                                                    'productRecommendations'
                                                )
                                                    ->relationship(
                                                        'productRecommendations',
                                                        'name'
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
                                                Forms\Components\FileUpload::make(
                                                    'image_url'
                                                )
                                                    ->hiddenLabel()
                                                    ->image(),
                                            ]),
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
                        Forms\Components\Tabs\Tab::make('FAQ')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Repeater::make('faqs')
                                            ->hiddenLabel()
                                            ->relationship()
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
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url'),
                Tables\Columns\TextColumn::make('meta_tag_h1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_tag_title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('indexation')
                    ->boolean(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
