<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatusDevicesOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('عدد الاجهزه ', Device::all()->count()),
            Card::make('الاجهزه الفعاله', Device::where("is_active", true)->count()),
            Card::make('الاجهزه  الغير الفعاله', Device::where("is_active", false)->count()),
        ];
    }
}
