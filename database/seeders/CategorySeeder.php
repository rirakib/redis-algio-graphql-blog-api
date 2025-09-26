<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $this->command->info("Seeding 3,000 Categories...");

        $batchSize = 1000; // insert in chunks
        $totalCategories = 3000;
        $now = now();

        for ($i = 0; $i < $totalCategories; $i += $batchSize) {
            $categories = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $word = fake()->word(); // no unique(), just base word
                $uniqueSuffix = $i + $j + 1; // ensures uniqueness

                $categories[] = [
                    'name' => ucfirst($word) . " " . $uniqueSuffix,
                    'slug' => Str::slug($word . '-' . $uniqueSuffix),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('categories')->insert($categories);
            $this->command->info("Inserted " . min($i + $batchSize, $totalCategories) . " categories...");
        }

        $this->command->info("Category seeding complete!");
    }
}
