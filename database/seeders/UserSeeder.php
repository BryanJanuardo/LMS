<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'UserName' => $faker->name(),
                'UserEmail' => $faker->email(),
                'UserPassword' => '1234567',
                'UserDOB' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'UserPhotoPath' => $faker->imageUrl(),
            ]);
        }
    }
}
