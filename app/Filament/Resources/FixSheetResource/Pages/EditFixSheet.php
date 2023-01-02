<?php

namespace App\Filament\Resources\FixSheetResource\Pages;

use App\Filament\Resources\FixSheetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFixSheet extends EditRecord
{
    protected static string $resource = FixSheetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
