<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class MaterialLearnings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $tempMaterialIDs = DB::table('materials')->pluck('MaterialID');

        if ($tempMaterialIDs->isEmpty()) {
            return;
        }

        for($i = 1; $i <= 30; $i++) {
            DB::table('material_learnings')->insert([
                [
                    'SessionLearningID' => $i,
                    'MaterialID' => $faker->randomElement($tempMaterialIDs),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
