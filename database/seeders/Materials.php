<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class Materials extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 1; $i <= 30; $i++) {
            DB::table('materials')->insert([
                [
                    'MaterialID' => 'M' . str_pad($i, 8, '0', STR_PAD_LEFT),
                    'MaterialName' => $faker->sentence(),
                    'MaterialType' => $faker->randomElement(['PPT', 'PDF', 'Video']),
                    'MaterialPath' => $faker->imageUrl(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
