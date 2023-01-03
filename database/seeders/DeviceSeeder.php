<?php

namespace Database\Seeders;

use App\Models\Device;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $this->command->info("seeding Device");

        Device::create([
            'name' => "جهاز اشعه",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id" => 1,
            "count" => rand(2, 50),
            "company" => $faker->company,
            "model" => $faker->company,
            "section_id" => 1
        ]);
        Device::create([
            'name' => "طبفي",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id" => 1,
            "count" => rand(2, 50),
            "company" =>  $faker->company,
            "model" => $faker->company,
            "section_id" => 1
        ]);
        Device::create([
            'name' => "ايكو philips",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id" => 1,
            "count" => rand(2, 50),
            "company" => $faker->company,
            "model" =>  $faker->company,
            "section_id" => 1
        ]);
        Device::create([
            'name' => "ايكو HDI",
            "SN" => Str::between('a', 'z', 10),
            "is_active" => false,
            "hospital_id" => 1,
            "count" => rand(2, 50),
            "company" =>  $faker->company,
            "model" =>  $faker->company,
            "section_id" => 1
        ]);
        $this->command->info("seeding Device DON");

    }
}
