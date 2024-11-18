<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sessionses')->insert([
            [
                'SessionID' => 'S001',
                'SessionName' => 'Introduction to LMS',
                'SessionDescription' => 'This session introduces the concepts of Learning Management Systems.',
                'SessionStart' => '2024-11-16',
                'SessionEnd' => '2024-11-16',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'SessionID' => 'S002',
                'SessionName' => 'Advanced LMS Features',
                'SessionDescription' => 'This session covers advanced features and tools in the LMS.',
                'SessionStart' => '2024-11-18',
                'SessionEnd' => '2024-11-18',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'SessionID' => 'S003',
                'SessionName' => 'Code Review',
                'SessionDescription' => 'Review code.',
                'SessionStart' => '2024-11-20',
                'SessionEnd' => '2024-11-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
