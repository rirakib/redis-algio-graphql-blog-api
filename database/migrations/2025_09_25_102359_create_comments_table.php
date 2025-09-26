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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('blog_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Blog this comment belongs to');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('User who wrote the comment');
            $table->text('content')->comment('Comment content');
            $table->timestamps();

            $table->index('created_at');
            $table->index(['blog_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
