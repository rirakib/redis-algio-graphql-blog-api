<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $this->command->info("Seeding 300,000 Blogs...");

        $batchSize  = 1000;   // safe size to avoid SQL placeholder limits
        $totalBlogs = 300000;
        $now        = now();

        // ✅ Fetch all category IDs once
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        // ✅ Fetch all user IDs once (instead of calling DB every loop)
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($categoryIds) || empty($userIds)) {
            $this->command->warn("⚠️ No categories or users found. Skipping blog seeding.");
            return;
        }

        // ✅ Loop in chunks
        $chunks = ceil($totalBlogs / $batchSize);

        for ($c = 0; $c < $chunks; $c++) {
            $blogs = [];

            for ($j = 0; $j < $batchSize && ($c * $batchSize + $j) < $totalBlogs; $j++) {
                $blogs[] = [
                    'category_id'     => $categoryIds[array_rand($categoryIds)],
                    'user_id'         => $userIds[array_rand($userIds)],
                    'title'           => fake()->sentence(),
                    'description'     => fake()->paragraph(5),
                    'seo_title'       => fake()->sentence(),
                    'seo_description' => fake()->paragraph(),
                    'meta_tags'       => implode(',', fake()->words(5)),
                    'status'          => fake()->randomElement(['active', 'deactive']),
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ];
            }

            DB::table('blogs')->insert($blogs);

            $this->command->info("Inserted " . min(($c + 1) * $batchSize, $totalBlogs) . " blogs...");
        }

        $this->command->info("✅ Blog seeding complete!");
    }
}
