<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("seeding Hospital ...");
        Hospital::create([
            'name' => "مشفى الشفاء",
            "phone" => "0958968962",
            "is_active" => true,
        ]);
        Hospital::create([
            'name' => "مشفى سرمدا",
            "phone" => "0958968962",
            "is_active" => true,
        ]);
        Hospital::create([
            'name' => "مشفى ادلب الجامعي",
            "phone" => "0958968962",
            "is_active" => false,
        ]);
        Hospital::create([
            'name' => "مشفى اريحا",
            "phone" => "0958968962",
            "is_active" => true,
        ]);
        $this->command->info("seeding Hospital DON");
    }
}
