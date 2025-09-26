<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Str;

class FillDataSeeder extends Seeder
{
    public function run()
    {
        // $this->command->info("Seeding started...");

        // $now = now();

        // // -----------------------------
        // // 1️⃣ Users
        // // -----------------------------
        // $this->command->info("Seeding 100,000 Users...");
        // $batchSize = 10000; // chunked insert
        // $totalUsers = 100000;

        // for ($i = 0; $i < $totalUsers; $i += $batchSize) {
        //     $users = [];
        //     for ($j = 0; $j < $batchSize; $j++) {
        //         $users[] = [
        //             'name' => fake()->name(),
        //             'email' => fake()->unique()->safeEmail(),
        //             'password' => bcrypt('password'),
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
        //     }
        //     DB::table('users')->insert($users);
        //     $this->command->info("Inserted " . min($i + $batchSize, $totalUsers) . " users...");
        // }

        // // -----------------------------
        // // 2️⃣ Categories
        // // -----------------------------
        // $this->command->info("Seeding 100 Categories...");
        // $categories = [];
        // for ($i = 0; $i < 100; $i++) {
        //     $categories[] = [
        //         'name' => fake()->word(),
        //         'slug' => Str::slug(fake()->unique()->words(2, true)),
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ];
        // }
        // DB::table('categories')->insert($categories);
        // $categoriesIds = DB::table('categories')->pluck('id');

        // // -----------------------------
        // // 3️⃣ Blogs
        // // -----------------------------
        // $this->command->info("Seeding 400,000 Blogs...");
        // $totalBlogs = 400000;

        // for ($i = 0; $i < $totalBlogs; $i += $batchSize) {
        //     $blogs = [];
        //     for ($j = 0; $j < $batchSize; $j++) {
        //         $blogs[] = [
        //             'category_id' => $categoriesIds->random(),
        //             'user_id' => User::inRandomOrder()->value('id'), // avoid pluck array
        //             'title' => fake()->sentence(),
        //             'description' => fake()->paragraph(3),
        //             'seo_title' => fake()->sentence(),
        //             'seo_description' => fake()->paragraph(),
        //             'meta_tags' => implode(',', fake()->words(5)),
        //             'status' => fake()->randomElement(['active', 'deactive']),
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
        //     }
        //     DB::table('blogs')->insert($blogs);
        //     $this->command->info("Inserted " . min($i + $batchSize, $totalBlogs) . " blogs...");
        // }

        // // -----------------------------
        // // 4️⃣ Comments
        // // -----------------------------
        // $this->command->info("Seeding 600,000 Comments...");
        // $totalComments = 600000;

        // for ($i = 0; $i < $totalComments; $i += $batchSize) {
        //     $comments = [];
        //     for ($j = 0; $j < $batchSize; $j++) {
        //         $comments[] = [
        //             'blog_id' => Blog::inRandomOrder()->value('id'),
        //             'user_id' => User::inRandomOrder()->value('id'),
        //             'content' => fake()->paragraph(),
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
        //     }
        //     DB::table('comments')->insert($comments);
        //     $this->command->info("Inserted " . min($i + $batchSize, $totalComments) . " comments...");
        // }

        // // -----------------------------
        // // 5️⃣ Replies
        // // -----------------------------
        // $this->command->info("Seeding 1,000,000 Replies...");
        // $totalReplies = 1000000;

        // for ($i = 0; $i < $totalReplies; $i += $batchSize) {
        //     $replies = [];
        //     for ($j = 0; $j < $batchSize; $j++) {
        //         $replies[] = [
        //             'comment_id' => Comment::inRandomOrder()->value('id'),
        //             'user_id' => User::inRandomOrder()->value('id'),
        //             'content' => fake()->paragraph(),
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
        //     }
        //     DB::table('replies')->insert($replies);
        //     $this->command->info("Inserted " . min($i + $batchSize, $totalReplies) . " replies...");
        // }

        // $this->command->info("Seeding complete!");
    }
}
