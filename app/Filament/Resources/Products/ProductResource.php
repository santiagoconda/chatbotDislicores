<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Product';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required(),
            TextInput::make('slug'),
            TextInput::make('description'),
            Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    ]),

        Select::make('brand_id')
            ->relationship('brand', 'name')
            ->searchable()
            ->preload()
            ->required(),

        TextInput::make('alcohol_percentage')
            ->numeric()
            ->suffix('%'),

        Select::make('type')
            ->options([
                'aguardiente' => 'Aguardiente',
                'ron' => 'Ron',
                'whisky' => 'Whisky',
                'vodka' => 'Vodka',
                'tequila' => 'Tequila',
                'cerveza' => 'Cerveza',
            ])
            ->required(),

        Select::make('age')
            ->options([
                'joven' => 'Joven',
                'añejo' => 'Añejo',
                'reserva' => 'Reserva',
                'extra_añejo' => 'Extra Añejo',
            ]),

        TextInput::make('origin_country')
            ->required(),

        TextInput::make('volume')
            ->integer()
            ->suffix('ml'),

        TextInput::make('price')
            ->numeric()
            ->prefix('$')
            ->required(),

        TextInput::make('discount_price')
            ->numeric()
            ->prefix('$'),

        TextInput::make('stock')
            ->integer()
            ->default(0),

        TextInput::make('min_stock')
            ->integer()
            ->default(1),

        TextInput::make('meta_title'),

        TextInput::make('meta_keywords'),

        Toggle::make('is_active')->default(true),
        Toggle::make('is_featured'),
        Toggle::make('is_new'),
        Toggle::make('is_on_sale'),

        TextInput::make('views')->integer()->default(0),
        TextInput::make('rating')->numeric()->step(0.1),
        TextInput::make('reviews_count')->integer()->default(0),
        ]);   
        }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);

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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}