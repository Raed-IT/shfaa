<?php

namespace App\Filament\Resources\DeviceResource\Pages;

use App\Exports\DeviceExport;
use App\Filament\Resources\DeviceResource;
use App\Filament\Resources\DeviceResource\Widgets\StatusDevicesOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

use Maatwebsite\Excel\Facades\Excel;

class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label("اضف جهاز"),
            Actions\Action::make('excel')->label('تصدير لاكسل')->action(function () {
                return new DeviceExport();
            })->color('success'),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatusDevicesOverview::class,
        ];
    }
}
