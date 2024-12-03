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
        Schema::create('material_learnings', function (Blueprint $table) {
            $table->id('MaterialLearningID')->primary();
            $table->unsignedBigInteger('SessionLearningID');
            $table->string('MaterialID');
            $table->foreign('SessionLearningID')->references('id')->on('session_learnings')->onDelete('cascade');
            $table->foreign('MaterialID')->references('MaterialID')->on('materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_learnings');
    }
};
