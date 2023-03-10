<?php

namespace App\Filament\Resources\HospitalResource\Pages;

use App\Filament\Resources\HospitalResource;
use App\Filament\Resources\HospitalResource\Widgets\StatusOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListHospitals extends ListRecords
{
    protected static string $resource = HospitalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label("اضافه مشفى"),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatusOverview::class,
        ];
    }
}
