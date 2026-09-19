<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactMessage extends EditRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Tự động đánh dấu "Đã đọc" khi admin mở xem, nếu đang ở trạng thái "Mới"
        if ($data['status'] === 'new') {
            $this->record->update(['status' => 'read']);
            $data['status'] = 'read';
        }

        return $data;
    }
}
