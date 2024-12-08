<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->string('ForumTitle');
            $table->text('ForumDescription');
            $table->date('CreatedDate');
            $table->string('FilePath')->nullable();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('SessionLearningID');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('SessionLearningID')->references('id')->on('session_learnings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
