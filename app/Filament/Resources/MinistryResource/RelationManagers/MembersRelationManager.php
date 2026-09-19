<?php

namespace App\Filament\Resources\MinistryResource\RelationManagers;

use App\Models\MinistryRole;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'memberships';

    protected static ?string $title = 'Members';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('person_id')
                ->label('Member')
                ->options(Person::members()->pluck('name', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\Select::make('ministry_role_id')
                ->label('Role')
                ->options(MinistryRole::pluck('name', 'id'))
                ->required(),
            Forms\Components\DatePicker::make('start_date')->required()->default(now()),
            Forms\Components\DatePicker::make('end_date'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('person.name')->label('Member')->searchable(),
                Tables\Columns\TextColumn::make('role.name')->label('Role'),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date()->placeholder('Đang phục vụ'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add Member'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Change Role'),
                Tables\Actions\Action::make('endService')
                    ->label('End Service')
                    ->icon('heroicon-o-stop-circle')
                    ->color('danger')
                    ->visible(fn ($record) => is_null($record->end_date))
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->endService()),
            ]);
    }
}
