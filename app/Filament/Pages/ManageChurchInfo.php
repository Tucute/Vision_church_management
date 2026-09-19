<?php

namespace App\Filament\Pages;

use App\Models\ChurchInfo;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageChurchInfo extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Church Info';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $title = 'Thông tin Hội Thánh';

    protected static string $view = 'filament.pages.manage-church-info';

    public ?array $data = [];

    public function mount(): void
    {
        $churchInfo = ChurchInfo::current();

        // Bung contact_info/social_links (JSON) ra field riêng cho dễ nhập,
        // thay vì bắt admin gõ tay JSON thô.
        $this->form->fill([
            'name' => $churchInfo->name,
            'founding_date' => $churchInfo->founding_date,
            'vision' => $churchInfo->vision,
            'mission' => $churchInfo->mission,
            'history' => $churchInfo->history,
            'address' => $churchInfo->address,
            'contact_phone' => $churchInfo->contact_info['phone'] ?? null,
            'contact_email' => $churchInfo->contact_info['email'] ?? null,
            'social_links' => $churchInfo->social_links ?? [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin chung')
                ->description('Các thông tin này sẽ hiển thị công khai trên trang Home, About và Footer của website.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Tên Hội Thánh')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('founding_date')
                        ->label('Ngày thành lập'),
                    Forms\Components\TextInput::make('address')
                        ->label('Địa chỉ')
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Giới thiệu (trang About)')
                ->schema([
                    Forms\Components\Textarea::make('vision')
                        ->label('Tầm nhìn')
                        ->rows(3),
                    Forms\Components\Textarea::make('mission')
                        ->label('Sứ mệnh')
                        ->rows(3),
                    Forms\Components\Textarea::make('history')
                        ->label('Lịch sử hình thành')
                        ->rows(4),
                ]),

            Forms\Components\Section::make('Liên hệ (hiển thị ở Footer & trang Contact)')
                ->schema([
                    Forms\Components\TextInput::make('contact_phone')
                        ->label('Số điện thoại')
                        ->tel(),
                    Forms\Components\TextInput::make('contact_email')
                        ->label('Email')
                        ->email(),
                ])->columns(2),

            Forms\Components\Section::make('Mạng xã hội')
                ->description('Thêm dòng mới cho mỗi nền tảng, vd key: facebook, value: link trang.')
                ->schema([
                    Forms\Components\KeyValue::make('social_links')
                        ->label('')
                        ->keyLabel('Nền tảng')
                        ->valueLabel('Link')
                        ->addActionLabel('Thêm mạng xã hội'),
                ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        ChurchInfo::current()->update([
            'name' => $data['name'],
            'founding_date' => $data['founding_date'],
            'vision' => $data['vision'],
            'mission' => $data['mission'],
            'history' => $data['history'],
            'address' => $data['address'],
            'contact_info' => [
                'phone' => $data['contact_phone'],
                'email' => $data['contact_email'],
            ],
            'social_links' => $data['social_links'] ?? [],
        ]);

        Notification::make()
            ->title('Đã lưu thông tin Hội Thánh')
            ->success()
            ->send();
    }
}