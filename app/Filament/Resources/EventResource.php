<?php

namespace App\Filament\Resources;

use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Event Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->columnSpanFull(),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
            Forms\Components\TextInput::make('location'),
            Forms\Components\Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'open' => 'Open',
                    'closed' => 'Closed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->required()
                ->default('draft'),
            Forms\Components\DateTimePicker::make('start_date')->required(),
            Forms\Components\DateTimePicker::make('end_date')->required(),
            Forms\Components\DateTimePicker::make('registration_start'),
            Forms\Components\DateTimePicker::make('registration_end'),
            Forms\Components\TextInput::make('capacity')->numeric(),
            Forms\Components\Toggle::make('registration_required')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('start_date')->dateTime()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'gray' => 'draft',
                    'success' => 'open',
                    'warning' => 'closed',
                    'primary' => 'completed',
                    'danger' => 'cancelled',
                ]),
                Tables\Columns\TextColumn::make('participants_count')->counts('participants')->label('Participants'),
                Tables\Columns\TextColumn::make('capacity')->placeholder('Unlimited'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft', 'open' => 'Open', 'closed' => 'Closed',
                    'completed' => 'Completed', 'cancelled' => 'Cancelled',
                ]),
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
            \App\Filament\Resources\EventResource\RelationManagers\RegistrationsRelationManager::class,
            \App\Filament\Resources\EventResource\RelationManagers\ParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\EventResource\Pages\ListEvents::route('/'),
            'create' => \App\Filament\Resources\EventResource\Pages\CreateEvent::route('/create'),
            'edit' => \App\Filament\Resources\EventResource\Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
