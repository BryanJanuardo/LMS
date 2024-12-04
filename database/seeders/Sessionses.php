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
            $start = $faker->dateTimeBetween('now', '+1 year');
            $rand = rand(1800, 10800);
            $end = (clone $start)->modify("+$rand seconds");

            DB::table('sessionses')->insert([
                'SessionID' => 'S' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'SessionName' => 'Session ' . $faker->sentence(),
                'SessionDescription' => $faker->paragraph(),
                'SessionStart' => $start,
                'SessionEnd' => $end,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
