<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SomeParentResource\Pages;
use App\Filament\Resources\SomeParentResource\RelationManagers;
use App\Models\SomeParent;
use App\Models\SomeParent\Enums\SomeEnum;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SomeParentResource extends Resource {

    protected static ?string $model = SomeParent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Radio::make('some_field')
                    ->options(SomeEnum::class)
                    ->default(SomeEnum::Second)
                    ->live(),
                Checkbox::make('other_field')
                    ->disabled(fn(Get $get) => $get('some_field') === SomeEnum::Second)
                    ->live(),
                Tabs::make('tabs')
                    ->tabs([
                        Tabs\Tab::make('first')
                            ->schema([
                                Fieldset::make('Child')
                                    ->relationship('someChild')
                                    ->schema([
                                        Checkbox::make('child_field')
                                            ->disabled(fn(Get $get) => $get('../some_field') === SomeEnum::Second)


                                    ])
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('some_field'),
                IconColumn::make('other_field')
                    ->boolean(),
                IconColumn::make('somechild.child_field')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListSomeParents::route('/'),
            'create' => Pages\CreateSomeParent::route('/create'),
            'edit' => Pages\EditSomeParent::route('/{record}/edit'),
        ];
    }
}
