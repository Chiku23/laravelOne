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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('created_by') // Foreign key referencing users table
                  ->constrained('users', 'user_id') // Reference the 'user_id' column on the 'users' table
                  ->onDelete('cascade'); // Optional: delete blogs when the user is deleted
            $table->string('title'); // Blog title
            $table->text('description'); // Blog description (use text for longer content)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
