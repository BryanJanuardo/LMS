<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Course::class,
            TasksTableSeeder::class,
            Sessionses::class,
            SessionLearnings::class,
            CourseLearnings::class,
            ForumPosts::class,
            ForumReplies::class
        ]);

    }
}
