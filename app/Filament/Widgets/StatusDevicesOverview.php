<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatusDevicesOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('عدد الاجهزه ', Device::all()->count())
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('الاجهزه الفعاله', Device::where("is_active", true)->count()),
            Card::make('الاجهزه  الغير الفعاله', Device::where("is_active", false)->count()),
        ];
    }
}
