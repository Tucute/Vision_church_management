<?php

namespace App\Filament\Resources\MinistryResource\RelationManagers;

use App\Models\MinistryRole;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'memberships';

    protected static ?string $title = 'Members';

    // Map tên role -> màu badge, để dễ thêm role mới sau này mà không phá logic
    private const ROLE_COLORS = [
        'Trưởng ban' => 'danger',   // đỏ - nổi bật nhất
        'Phó ban' => 'warning',     // vàng cam - nổi bật thứ 2
        'Thành viên' => 'gray',     // xám - mặc định
    ];

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
                Tables\Columns\TextColumn::make('person.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),

                // Highlight: Trưởng ban / Phó ban nổi bật màu riêng, Thành viên màu xám mặc định
                Tables\Columns\TextColumn::make('role.name')
                    ->label('Role')
                    ->badge()
                    ->color(fn (?string $state) => self::ROLE_COLORS[$state] ?? 'gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->date()->placeholder('—')->sortable(),

                Tables\Columns\TextColumn::make('is_active')
                    ->label('Trạng thái')
                    ->state(fn ($record) => is_null($record->end_date) ? 'Đang phục vụ' : 'Đã kết thúc')
                    ->badge()
                    ->color(fn ($record) => is_null($record->end_date) ? 'success' : 'gray'),
            ])
            ->filters([
                // Filter theo trạng thái đang phục vụ / đã kết thúc
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'active' => 'Đang phục vụ',
                        'ended' => 'Đã kết thúc',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match ($data['value'] ?? null) {
                            'active' => $query->whereNull('end_date'),
                            'ended' => $query->whereNotNull('end_date'),
                            default => $query,
                        };
                    }),

                // Filter theo role
                Tables\Filters\SelectFilter::make('ministry_role_id')
                    ->label('Role')
                    ->relationship('role', 'name'),

                // Filter theo khoảng thời gian bắt đầu phục vụ (start_date)
                Tables\Filters\Filter::make('start_date_range')
                    ->label('Ngày bắt đầu')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Từ ngày'),
                        Forms\Components\DatePicker::make('until')->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('start_date', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('start_date', '<=', $date));
                    })
                    ->indicateUsing(function (array $data) {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = 'Từ '.\Carbon\Carbon::parse($data['from'])->format('d/m/Y');
                        }
                        if ($data['until'] ?? null) {
                            $indicators[] = 'Đến '.\Carbon\Carbon::parse($data['until'])->format('d/m/Y');
                        }

                        return $indicators;
                    }),
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