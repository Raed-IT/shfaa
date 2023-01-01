<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
            'name' => "جهاز اشعه",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id"=>1
        ]);
        Device::create([
            'name' => "طبفي",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id"=>1
        ]);
        Device::create([
            'name' => "ايكو philips",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id"=>1
        ]);
        Device::create([
            'name' => "ايكو HDI",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id"=>1
        ]);
    }
}
