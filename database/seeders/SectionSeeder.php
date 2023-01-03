<?php

namespace Database\Seeders;

use App\Models\Section;use Faker\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Section::create([
                'name' =>$faker->name."قسم او عياده",
                "hospital_id"=>1
            ]);
        }
    }
}
