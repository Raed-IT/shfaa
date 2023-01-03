<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("  seeding SettingSeeder ");

        Setting::create([
            "hospital_id" => 1
        ]);
        $this->command->info(" DON seeding SettingSeeder ");

    }
}
