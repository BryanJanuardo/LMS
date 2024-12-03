<?php

namespace Database\Seeders;

use App\Models\ForumPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ForumPosts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 30; $i++) {
            ForumPost::create([
                'ForumTitle' => $faker->sentence(),
                'ForumDescription' => $faker->paragraph(),
                'CreatedDate' => $faker->dateTimeBetween('now', '+1 year'),
                'FilePath' => $faker->imageUrl(),
                'UserID' => rand(1, 20),
                'SessionLearningID' => rand(1, 30)
            ]);
        }
    }
}
