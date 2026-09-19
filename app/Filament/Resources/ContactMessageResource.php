<?php

namespace App\Filament\Resources;

use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Public Site';

    protected static ?string $navigationBadgeTooltip = 'Tin nhắn mới';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\TextInput::make('subject')->disabled(),
            Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
            Forms\Components\Select::make('status')
                ->options(['new' => 'Mới', 'read' => 'Đã đọc', 'replied' => 'Đã trả lời'])
                ->required(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('subject')->limit(40),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'danger' => 'new', 'warning' => 'read', 'success' => 'replied',
                ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['new' => 'Mới', 'read' => 'Đã đọc', 'replied' => 'Đã trả lời']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ContactMessageResource\Pages\ListContactMessages::route('/'),
            'edit' => \App\Filament\Resources\ContactMessageResource\Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
