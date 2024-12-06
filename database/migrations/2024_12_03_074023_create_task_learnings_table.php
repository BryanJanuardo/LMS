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
        Schema::create('task_learnings', function (Blueprint $table) {
            $table->id('TaskLearningID');
            $table->unsignedBigInteger('SessionLearningID');
            $table->unsignedBigInteger('TaskID');
            $table->foreign('SessionLearningID')->references('id')->on('session_learnings')->onDelete('cascade');
            $table->foreign('TaskID')->references('TaskID')->on('tasks')->onDelete('cascade');
            $table->string('TaskType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_learnings');
    }
};
