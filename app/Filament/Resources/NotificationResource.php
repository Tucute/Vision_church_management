<?php

namespace App\Filament\Resources;

use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'Notification Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('subject')->required()->columnSpanFull(),
            Forms\Components\DateTimePicker::make('time'),
            Forms\Components\TextInput::make('location'),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('time')->dateTime(),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['gray' => 'draft', 'success' => 'published']),
                Tables\Columns\TextColumn::make('creator.name')->label('Created By'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->placeholder('—'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('publish')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn (Notification $record) => $record->status === 'draft')
                    ->requiresConfirmation()
                    ->action(fn (Notification $record) => $record->publish()),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\NotificationResource\Pages\ListNotifications::route('/'),
            'create' => \App\Filament\Resources\NotificationResource\Pages\CreateNotification::route('/create'),
            'edit' => \App\Filament\Resources\NotificationResource\Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
