<?php

namespace App\Filament\Resources;

use App\Models\Category;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Finance Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options(['income' => 'Income', 'expense' => 'Expense'])
                ->required()
                ->live(),

            // Category chỉ hiện đúng loại đã chọn (income/expense)
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->options(fn (Forms\Get $get) => Category::where('type', $get('type'))->pluck('name', 'id'))
                ->required(),

            Forms\Components\Select::make('fund_id')
                ->relationship('fund', 'name')
                ->required(),

            Forms\Components\Select::make('contributor_id')
                ->relationship('contributor', 'name')
                ->searchable()
                ->nullable(),

            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->prefix('₫')
                ->required(),

            Forms\Components\DatePicker::make('transaction_date')->required()->default(now()),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_date')->date()->sortable(),
                Tables\Columns\BadgeColumn::make('type')->colors(['success' => 'income', 'danger' => 'expense']),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('fund.name'),
                Tables\Columns\TextColumn::make('amount')->money('VND')->sortable(),
                Tables\Columns\TextColumn::make('contributor.name')->placeholder('—'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['warning' => 'pending', 'success' => 'approved', 'danger' => 'rejected']),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['income' => 'Income', 'expense' => 'Expense']),
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']),
                Tables\Filters\SelectFilter::make('fund_id')->relationship('fund', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Transaction $record) => $record->status === 'pending'),

                // Chỉ Admin/Approver mới thấy nút approve/reject
                Tables\Actions\Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (Transaction $record) => $record->status === 'pending' && auth()->user()->isApprover())
                    ->requiresConfirmation()
                    ->action(fn (Transaction $record) => $record->approve(auth()->user())),

                Tables\Actions\Action::make('reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (Transaction $record) => $record->status === 'pending' && auth()->user()->isApprover())
                    ->requiresConfirmation()
                    ->action(fn (Transaction $record) => $record->reject(auth()->user())),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\TransactionResource\Pages\ListTransactions::route('/'),
            'create' => \App\Filament\Resources\TransactionResource\Pages\CreateTransaction::route('/create'),
            'edit' => \App\Filament\Resources\TransactionResource\Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
