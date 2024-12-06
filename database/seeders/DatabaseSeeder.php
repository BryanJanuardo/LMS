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
            UserSeeder::class,
            RoleSeeder::class,
            Course::class,
            Tasks::class,
            Sessionses::class,
            CourseLearnings::class,
            SessionLearnings::class,
            ForumPosts::class,
            ForumReplies::class,
            UserCourseSeeder::class,
            Materials::class,
            MaterialLearnings::class,
            TaskLearnings::class
        ]);

    }
}
