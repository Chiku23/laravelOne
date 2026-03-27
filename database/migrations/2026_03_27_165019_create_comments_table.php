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
            $table->id(); // Primary key
            $table->foreignId('created_by') // Foreign key referencing users table
                  ->constrained('users', 'user_id') 
                  ->onDelete('cascade'); 
            $table->foreignId('blog_id') // Foreign key referencing blogs table
                  ->constrained('blogs', 'id')
                  ->onDelete('cascade'); 
            $table->text('comment'); // Blog description (use text for longer content)
            $table->foreignId('parent_id') // Foreign key referencing comments table
                  ->onDelete('cascade')
                  ->nullable()->default(null); 
            $table->timestamps();
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
