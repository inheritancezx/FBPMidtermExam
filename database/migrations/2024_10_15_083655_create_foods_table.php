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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('course_id')->constrained(
                table: 'courses',
                indexName: 'food_course_id'
            );
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'food_category_id'
            );
            $table->string('slug')->unique();
            $table->string('image');
            $table->integer('likes');
            $table->string('est_price');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
