<?php

namespace App\Filament\Resources\FixSheetResource\Pages;

use App\Filament\Resources\FixSheetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFixSheets extends ListRecords
{
    protected static string $resource = FixSheetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('اضافه تقرير اصلاح'),
        ];
    }
}
