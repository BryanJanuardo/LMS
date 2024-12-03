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
        Schema::create('user_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('CourseLearningID');
            $table->unsignedBigInteger('RoleID');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('CourseLearningID')->references('id')->on('course_learnings')->onDelete('cascade');
            $table->foreign('RoleID')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_courses');
    }
};
