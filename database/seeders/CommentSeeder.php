<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("Seeding 2,000,000 Comments...");

        $batchSize = 5000;  
        $total     = 2000000;
        $now       = now();

        // ✅ Fetch blog IDs & user IDs once
        $blogIds = DB::table('blogs')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($blogIds) || empty($userIds)) {
            $this->command->warn("⚠️ No blogs or users found. Skipping comment seeding.");
            return;
        }

        $chunks = ceil($total / $batchSize);

        for ($c = 0; $c < $chunks; $c++) {
            // ✅ Generate this batch in one go (no nested loop)
            $comments = collect(range(1, $batchSize))
                ->map(function () use ($blogIds, $userIds, $now, $total, $c, $batchSize) {
                    $index = $c * $batchSize;
                    if ($index >= $total) {
                        return null; // stop extra rows on last batch
                    }
                    return [
                        'blog_id'    => $blogIds[array_rand($blogIds)],
                        'user_id'    => $userIds[array_rand($userIds)],
                        'content'    => fake()->sentence(12),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                })
                ->filter() // remove nulls on last batch
                ->toArray();

            DB::table('comments')->insert($comments);

            $inserted = min(($c + 1) * $batchSize, $total);
            $this->command->info("Inserted {$inserted} / {$total} comments...");
        }

        $this->command->info("✅ Comment seeding complete!");
    }
}
