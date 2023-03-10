<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use Filament\Widgets\BarChartWidget;

class DeviceChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
                "borderColor" => "#fffff",
                "color" => 'red',
            ],
            "color" => 'red',
        ],
    ];

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'الاجهزه الغير الفعاله',
                    'data' => Device::CountDeviceBerLateMonths(false),
                ],
                [
                    'label' => 'الاجهزه الفعاله',
                    'data' => Device::CountDeviceStatuesBerLateMonths(true),
                ],
                [
                    'label' => 'الاجهزه المضافه',
                    'data' => Device::CountDeviceBerLateMonths(),
                ],
            ],
            'labels' => ['كانون الثاني(1)', ' شباط (2)', 'آذار(3)', ' نيسان(4)', 'أيار(5)', 'حزيران(6)', ' تموز(7)', 'آب(8)', ' أيلول(9)', ' تشرين الأول(10)', ' تشرين الثاني(11)', 'كانون الأول(12)'],
        ];
    }
}
