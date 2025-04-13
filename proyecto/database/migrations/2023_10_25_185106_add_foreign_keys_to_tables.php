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
        Schema::table('tests', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('language_id')->constrained();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('test_id')->constrained()->cascadeOnDelete();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreignId('question_id')->constrained();
        });

        Schema::table('libraries', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->constrained();
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('test_id')->constrained();
        });

        Schema::table('test_results', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('test_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
