<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'TaskName' => 'Complete project documentation',
                'TaskDesc' => 'Prepare detailed documentation for the ongoing project.',
                'TaskType' => 'Documentation',
                'TaskDueDate' => '2024-11-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'TaskName' => 'Develop API endpoints',
                'TaskDesc' => 'Build RESTful API endpoints for user management.',
                'TaskType' => 'Development',
                'TaskDueDate' => '2024-11-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'TaskName' => 'Design landing page',
                'TaskDesc' => 'Create a responsive design for the product landing page.',
                'TaskType' => 'Design',
                'TaskDueDate' => '2024-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
