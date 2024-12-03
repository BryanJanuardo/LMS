<?php

namespace Database\Seeders;

use App\Models\ForumReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ForumReplies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 30; $i++) {
            ForumReply::create([
                'PostID' => rand(1, 30),
                'UserID' => rand(1, 20),
                'CreatedDate' => $faker->dateTimeBetween('now', '+1 year'),
                'ReplyMessages' => $faker->paragraph(),
                'FilePath' => $faker->imageUrl()
            ]);
        }
    }
}
