<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseLearnings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classId = ['FLA001', 'WEB001', 'MOB001', 'CYB001', 'NET001'];
        $class = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        for($i = 1; $i <= 30; $i++) {
            DB::table('course_learnings')->insert([
                'id' => $i,
                'ClassName' => $class[rand(0, 25)] . $class[rand(0, 25)] . '-' . str_pad(rand(1, 100), 2, '0', STR_PAD_LEFT),
                'CourseID' => $classId[rand(0, 4)],
                'SessionLearningID' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
