<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Sessionses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i < 30; $i++) {
            DB::table('sessionses')->insert([
                'SessionID' => 'S' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'SessionName' => 'Session ' . $faker->sentence(),
                'SessionDescription' => $faker->paragraph(),
                'SessionStart' => $faker->dateTimeBetween('now', '+1 year'),
                'SessionEnd' => $faker->dateTimeBetween('now', '+1 year'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
