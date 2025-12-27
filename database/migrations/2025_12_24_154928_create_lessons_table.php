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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id('lesson_id');
            // $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('course_id')
                ->on('courses')
                ->onDelete('cascade');

            $table->string('title');
            $table->integer('duration_minutes');
            $table->enum('type', ['video', 'pdf', 'quiz']);
            $table->boolean('is_free')->default(false);
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
