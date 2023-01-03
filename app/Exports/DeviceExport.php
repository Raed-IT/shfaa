<?php

namespace App\Exports;

use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class DeviceExport implements FromCollection, WithHeadings, Responsable
{


    use Exportable;

    private $fileName = 'Deices.xlsx';
    private $writerType = Excel::XLSX;

    public function headings(): array
    {
        return [
            '#',
            'اسم الجهاز',
            'S/N',
            "العدد",
            "المشفى",
            "القسم",
            "تاريخ الاضافه"
        ];
    }

    public function collection()
    {
        return DeviceResource::collection( Device::all());
    }
}
