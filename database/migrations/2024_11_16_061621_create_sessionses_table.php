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
        Schema::create('sessionses', function (Blueprint $table) {
            $table->string('SessionID')->primary();
            $table->string('SessionName');
            $table->longText('SessionDescription');
            $table->dateTime('SessionStart');
            $table->dateTime('SessionEnd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
