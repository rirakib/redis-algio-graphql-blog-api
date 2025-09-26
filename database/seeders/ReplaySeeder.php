<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReplaySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("Seeding 200,000 Replies...");

        $batchSize = 5000;  // safe batch size to avoid memory/SQL errors
        $total     = 200000;
        $now       = now();

        // ✅ Fetch comment IDs & user IDs once
        $commentIds = DB::table('comments')->pluck('id')->toArray();
        $userIds    = DB::table('users')->pluck('id')->toArray();

        if (empty($commentIds) || empty($userIds)) {
            $this->command->warn("⚠️ No comments or users found. Skipping reply seeding.");
            return;
        }

        $chunks = ceil($total / $batchSize);

        for ($c = 0; $c < $chunks; $c++) {
            // ✅ Generate one batch without nested loops
            $replies = collect(range(1, $batchSize))
                ->map(function () use ($commentIds, $userIds, $now, $total, $c, $batchSize) {
                    $index = $c * $batchSize;
                    if ($index >= $total) {
                        return null; // avoid overshooting on last batch
                    }
                    return [
                        'comment_id' => $commentIds[array_rand($commentIds)],
                        'user_id'    => $userIds[array_rand($userIds)],
                        'content'    => fake()->sentence(15),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                })
                ->filter() // remove nulls if any
                ->toArray();

            DB::table('replies')->insert($replies);

            $inserted = min(($c + 1) * $batchSize, $total);
            $this->command->info("Inserted {$inserted} / {$total} replies...");
        }

        $this->command->info("✅ Reply seeding complete!");
    }
}
