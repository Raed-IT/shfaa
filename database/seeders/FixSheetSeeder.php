<?php

namespace Database\Seeders;

use App\Models\FixSheet;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FixSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();
        $this->command->info("seeding FixSheet ...");

        FixSheet::create([
            'diagnosis' =>  $faker->word,
            "solution" =>   $faker->word,
            "description" =>  $faker->paragraph(),
            "status" => 'Invalid',
            "device_id" => 1,
            "user_id" => 1,

        ]);
        FixSheet::create([
            'diagnosis' =>  $faker->word,
            "solution" =>  $faker->word,
            "description" => $faker->paragraph(),

            "status" => 'Waiting',
            "device_id" => 2,
            "user_id" => 5,

        ]);
        FixSheet::create([
            'diagnosis' => $faker->word,
            "solution" => $faker->word,
            "description" =>$faker->paragraph(),
            "status" => 'Active',
            "device_id" => 2,
            "user_id" => 3,
        ]);
        FixSheet::create([
            'diagnosis' => $faker->word,
            "solution" =>  $faker->word,
            "description" => $faker->paragraph(),
            "status" => 'Active',
            "device_id" => 1,
            "user_id" => 4,

        ]);
        FixSheet::create([
            'diagnosis' =>  $faker->word ,
            "solution" =>  $faker->word ,
            "description" => $faker->paragraph(),

            "status" => 'Don',
            "device_id" => 3,
            "user_id" => 2,

        ]);
        $this->command->info("seeding FixSheet DON");

    }
}
