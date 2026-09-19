<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('participant_type')
                ->options(['member' => 'Existing Person', 'external' => 'External Participant'])
                ->live()
                ->required(),

            Forms\Components\Select::make('person_id')
                ->label('Person')
                ->options(Person::pluck('name', 'id'))
                ->searchable()
                ->visible(fn (Forms\Get $get) => $get('participant_type') === 'member')
                ->required(fn (Forms\Get $get) => $get('participant_type') === 'member'),

            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('email')->email(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BadgeColumn::make('participant_type'),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'success' => 'approved', 'danger' => 'rejected', 'gray' => 'cancelled',
                ]),
                Tables\Columns\TextColumn::make('attendances.status')->label('Attendance')->badge(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add manually'),
            ])
            ->actions([
                Tables\Actions\Action::make('markPresent')
                    ->label('Mark Present')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn ($record) => $record->attendances()->create([
                        'status' => 'present',
                        'attendance_date' => now(),
                    ])),
                Tables\Actions\Action::make('markAbsent')
                    ->label('Mark Absent')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn ($record) => $record->attendances()->create([
                        'status' => 'absent',
                        'attendance_date' => now(),
                    ])),
                Tables\Actions\DeleteAction::make()->label('Remove/Cancel'),
            ]);
    }
}
