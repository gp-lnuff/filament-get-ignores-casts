<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Actions\EditAction;
use App\Filament\Resources\SomeParentResource\Pages\ListSomeParents;
use App\Filament\Resources\SomeParentResource\Pages\CreateSomeParent;
use App\Filament\Resources\SomeParentResource\Pages\EditSomeParent;
use App\Models\SomeParent;
use App\Models\SomeParent\Enums\SomeEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SomeParentResource extends Resource {

    protected static ?string $model = SomeParent::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema {
        return $schema
            ->components([
                Radio::make('some_field')
                    ->options(SomeEnum::class)
                    ->default(SomeEnum::Second)
                    ->live(),
                Checkbox::make('other_field')
                    ->disabled(fn(Get $get) => $get('some_field') === SomeEnum::Second)
                    ->live(),
                Tabs::make('tabs')
                    ->tabs([
                        Tab::make('first')
                            ->schema([
                                Fieldset::make('field')
                                    ->relationship('someChild')
                                    ->schema([
                                        Checkbox::make('child_field')
                                            ->required(fn(Get $get) => dd($get('../some_field')) === SomeEnum::Second)


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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListSomeParents::route('/'),
            'create' => CreateSomeParent::route('/create'),
            'edit' => EditSomeParent::route('/{record}/edit'),
        ];
    }
}
