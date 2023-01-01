<?php

namespace App\Filament\Resources\HospitalResource\Widgets;

use App\Models\Hospital;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatusOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getCards(): array
    {
        return [
            Card::make('عدد المشافي ', Hospital::all()->count()),
            Card::make('المشافي الفعاله', Hospital::where("is_active",true)->count()),
            Card::make('المشافي  الغير الفعاله', Hospital::where("is_active",false)->count()),
        ];
    }
}
