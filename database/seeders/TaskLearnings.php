<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class TaskLearnings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 1; $i <= 30; $i++) {
            DB::table('task_learnings')->insert([
                [
                    'SessionLearningID' => $i,
                    'TaskID' => rand(1, 3),
                    'TaskType' => $faker->randomElement(['Quiz', 'Assignment']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
