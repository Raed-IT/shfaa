<?php

namespace App\Filament\Resources\DeviceResource\Pages;

use App\Filament\Resources\DeviceResource;
use App\Filament\Resources\DeviceResource\Widgets\StatusDevicesOverview;
use App\Filament\Resources\HospitalResource\Widgets\StatusOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label("اضف جهاز"),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            StatusDevicesOverview::class,
        ];
    }
}
