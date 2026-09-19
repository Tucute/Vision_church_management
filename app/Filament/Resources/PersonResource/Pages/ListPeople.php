<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()->label('Add Person'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'newcomer' => Tab::make('Newcomers')
                ->modifyQueryUsing(fn ($query) => $query->where('person_type', 'newcomer')),
            'member' => Tab::make('Members')
                ->modifyQueryUsing(fn ($query) => $query->where('person_type', 'member')),
        ];
    }
}