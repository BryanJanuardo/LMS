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
            Tasks::class,
            Sessionses::class,
            SessionLearnings::class,
            CourseLearnings::class,
            ForumPosts::class,
            ForumReplies::class,
            Materials::class,
            MaterialLearnings::class,
            TaskLearnings::class
        ]);

    }
}
