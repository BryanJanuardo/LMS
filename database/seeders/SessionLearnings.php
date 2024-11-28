<?php

namespace Database\Seeders;

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
        for($i = 1; $i <= 30; $i++) {
            DB::table('session_learnings')->insert([
                [
                    'id' => $i,
                    'SessionID' => 'S' . str_pad($i - 1, 8, '0', STR_PAD_LEFT),
                    'TaskID' => rand(1, 3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }

    }
}
