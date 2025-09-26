<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    public function run()
    {
        $this->command->info("Seeding 30,000 Users...");

        $faker = Faker::create();
        $batchSize = 5000;
        $totalUsers = 30000;
        $now = now();

        // Pre-hash password once (instead of inside loop every time)
        $hashedPassword = Hash::make('password');

        // Chunk insert
        $chunks = $totalUsers / $batchSize;
        for ($c = 0; $c < $chunks; $c++) {
            $users = collect(range(1, $batchSize))->map(function () use ($faker, $hashedPassword, $now) {
                return [
                    'name'       => $faker->name(),
                    'email'      => $faker->unique()->safeEmail(),
                    'password'   => $hashedPassword,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->toArray();

            DB::table('users')->insert($users);
            $this->command->info("Inserted " . (($c + 1) * $batchSize) . " users...");
        }

        $this->command->info("✅ User seeding complete!");
    }
}
