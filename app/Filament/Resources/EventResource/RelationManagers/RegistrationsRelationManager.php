<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('person_id')
                ->options(Person::pluck('name', 'id'))
                ->searchable()
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('person.name'),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'warning' => 'pending', 'success' => 'approved',
                    'danger' => 'rejected', 'gray' => 'cancelled',
                ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Registered At'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->approve(auth()->user())),

                Tables\Actions\Action::make('reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->reject(auth()->user())),
            ]);
    }
}
