<?php

namespace Database\Seeders;

use App\Models\UserCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 120; $i++) {
            UserCourse::create([
                'UserID' => $faker->numberBetween(1, 20),
                'CourseLearningID' => $faker->numberBetween(1, 10),
                'RoleID' => $faker->numberBetween(1, 2)
            ]);
        }
    }
}
