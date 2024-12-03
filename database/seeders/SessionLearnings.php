<?php

namespace Database\Seeders;

use App\Models\SessionLearning;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionLearnings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            for($j = 1; $j <= rand(4, 30); $j++) {
                SessionLearning::create([
                    'SessionID' => 'S' . str_pad($j - 1, 8, '0', STR_PAD_LEFT),
                    'CourseLearningID' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
