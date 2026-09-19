<?php

namespace App\Filament\Resources;

use App\Models\Fund;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FundResource extends Resource
{
    protected static ?string $model = Fund::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationGroup = 'Finance Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('balance')->money('VND')->label('Số dư hiện tại'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\FundResource\Pages\ListFunds::route('/'),
            'create' => \App\Filament\Resources\FundResource\Pages\CreateFund::route('/create'),
            'edit' => \App\Filament\Resources\FundResource\Pages\EditFund::route('/{record}/edit'),
        ];
    }
}
