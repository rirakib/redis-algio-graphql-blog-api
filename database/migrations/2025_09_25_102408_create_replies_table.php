<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id(); // bigIncrements

            // Foreign keys
            $table->foreignId('comment_id')
                ->constrained('comments') // references comments.id
                ->onDelete('cascade')
                ->comment('Comment this reply belongs to');

            $table->foreignId('user_id')
                ->constrained('users') // references users.id
                ->onDelete('cascade')
                ->comment('User who wrote the reply');

            $table->text('content')->comment('Reply content');

            $table->timestamps(); // created_at & updated_at

            // Indexes for performance
            $table->index('created_at');                  // sorting by newest
            $table->index(['comment_id', 'user_id']);     // common query: replies for a comment by user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
