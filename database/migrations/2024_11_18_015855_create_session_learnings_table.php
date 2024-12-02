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
        Schema::create('session_learnings', function (Blueprint $table) {
            $table->id();
            $table->string('SessionID');
            $table->unsignedBigInteger('TaskID');
            $table->foreign('SessionID')->references('SessionID')->on('sessionses')->onDelete('cascade');
            $table->foreign('TaskID')->references('TaskID')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_learnings');
    }
};
