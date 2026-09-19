<?php

namespace App\Filament\Resources;

use App\Models\Contributor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContributorResource extends Resource
{
    protected static ?string $model = Contributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationGroup = 'Finance Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options(['member' => 'Member', 'external' => 'External'])
                ->live()
                ->required(),
            Forms\Components\Select::make('person_id')
                ->relationship('person', 'name')
                ->searchable()
                ->visible(fn (Forms\Get $get) => $get('type') === 'member')
                ->required(fn (Forms\Get $get) => $get('type') === 'member'),
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('email')->email(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('type'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['member' => 'Member', 'external' => 'External']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ContributorResource\Pages\ListContributors::route('/'),
            'create' => \App\Filament\Resources\ContributorResource\Pages\CreateContributor::route('/create'),
            'edit' => \App\Filament\Resources\ContributorResource\Pages\EditContributor::route('/{record}/edit'),
        ];
    }
}
