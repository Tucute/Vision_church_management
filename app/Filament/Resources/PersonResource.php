<?php

namespace App\Filament\Resources;

use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Person Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Basic Information')->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options(['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác']),
                Forms\Components\DatePicker::make('date_of_birth'),
                Forms\Components\TextInput::make('hometown'),
                Forms\Components\TextInput::make('occupation')->label('Current Occupation'),
                Forms\Components\Select::make('marital_status')
                    ->label('Tình trạng mối quan hệ')
                    ->options([
                        'single' => 'Độc thân',
                        'married' => 'Đã kết hôn',
                        'divorced' => 'Đã ly hôn',
                        'widowed' => 'Góa',
                    ]),
                Forms\Components\TextInput::make('phone')->tel(),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('address'),
                Forms\Components\Textarea::make('family_background')
                    ->label('Bối cảnh gia đình')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Membership')->schema([
                Forms\Components\Select::make('person_type')
                    ->options(['newcomer' => 'Newcomer', 'member' => 'Member'])
                    ->required()
                    ->live(),
                Forms\Components\Select::make('member_status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                    ->visible(fn (Forms\Get $get) => $get('person_type') === 'member'),
                Forms\Components\DatePicker::make('member_since')
                    ->visible(fn (Forms\Get $get) => $get('person_type') === 'member'),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('person_type')
                    ->colors(['warning' => 'newcomer', 'success' => 'member']),
                Tables\Columns\TextColumn::make('member_status')->badge(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->label('Marital Status')
                    ->formatStateUsing(fn (?string $state) => match ($state) {
                        'single' => 'Độc thân',
                        'married' => 'Đã kết hôn',
                        'divorced' => 'Đã ly hôn',
                        'widowed' => 'Góa',
                        default => '—',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('age')->label('Age'),
                Tables\Columns\TextColumn::make('hometown')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('person_type')
                    ->options(['newcomer' => 'Newcomer', 'member' => 'Member']),
                Tables\Filters\SelectFilter::make('member_status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive']),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác']),
                Tables\Filters\SelectFilter::make('marital_status')
                    ->label('Marital Status')
                    ->options([
                        'single' => 'Độc thân',
                        'married' => 'Đã kết hôn',
                        'divorced' => 'Đã ly hôn',
                        'widowed' => 'Góa',
                    ]),
                Tables\Filters\Filter::make('hometown')
                    ->form([Forms\Components\TextInput::make('hometown')])
                    ->query(fn ($query, array $data) => $query->when(
                        $data['hometown'],
                        fn ($q, $value) => $q->where('hometown', 'like', "%{$value}%")
                    )),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                // Approve Newcomer -> Member (đúng flow trong spec)
                Tables\Actions\Action::make('approve')
                    ->label('Approve → Member')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Person $record) => $record->person_type === 'newcomer')
                    ->form([
                        Forms\Components\DatePicker::make('member_since')->required()->default(now()),
                    ])
                    ->requiresConfirmation()
                    ->action(function (Person $record, array $data) {
                        $record->approveAsMember($data, auth()->user());
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Person $record) => $record->person_type === 'newcomer')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')->required(),
                    ])
                    ->requiresConfirmation()
                    ->action(fn (Person $record, array $data) => $record->rejectNewcomer($data['rejection_reason'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\PersonResource\Pages\ListPeople::route('/'),
            'create' => \App\Filament\Resources\PersonResource\Pages\CreatePerson::route('/create'),
            'edit' => \App\Filament\Resources\PersonResource\Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}