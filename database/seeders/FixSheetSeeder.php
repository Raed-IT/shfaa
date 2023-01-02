<?php

namespace Database\Seeders;

use App\Models\FixSheet;
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
                $this->command->info("seeding FixSheet ...");

        FixSheet::create([
            'diagnosis' => Str::random(5),
            "solution" => Str::random(15),
            "description" => Str::random(500),
            "status" => 'Invalid',
            "device_id" => 1,
            "user_id" => 1,

        ]);
        FixSheet::create([
            'diagnosis' => Str::random(5),
            "solution" => Str::random(15),
            "description" => Str::random(500),
            "status" => 'Waiting',
            "device_id" => 2,
            "user_id" => 5,

        ]);
        FixSheet::create([
            'diagnosis' => Str::random(5),
            "solution" => Str::random(15),
            "description" => Str::random(500),
            "status" => 'Active',
            "device_id" => 2,
            "user_id" => 3,
        ]);
        FixSheet::create([
            'diagnosis' => Str::random(5),
            "solution" => Str::random(15),
            "description" => Str::random(500),
            "status" => 'Active',
            "device_id" => 1,
            "user_id" => 4,

        ]);
        FixSheet::create([
            'diagnosis' => Str::random(5),
            "solution" => Str::random(15),
            "description" => Str::random(500),
            "status" => 'Don',
            "device_id" => 3,
            "user_id" => 2,

        ]);
        $this->command->info("seeding FixSheet DON");

    }
}
