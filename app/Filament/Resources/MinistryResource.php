<?php

namespace App\Filament\Resources;

use App\Models\Ministry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MinistryResource extends Resource
{
    protected static ?string $model = Ministry::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Ministry Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->limit(60),
                Tables\Columns\TextColumn::make('active_memberships_count')
                    ->counts('activeMemberships')
                    ->label('Active Members'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\MinistryResource\RelationManagers\MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\MinistryResource\Pages\ListMinistries::route('/'),
            'create' => \App\Filament\Resources\MinistryResource\Pages\CreateMinistry::route('/create'),
            'edit' => \App\Filament\Resources\MinistryResource\Pages\EditMinistry::route('/{record}/edit'),
        ];
    }
}
