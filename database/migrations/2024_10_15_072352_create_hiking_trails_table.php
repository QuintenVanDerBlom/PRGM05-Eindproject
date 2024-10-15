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
        Schema::create('hiking_trails', function (Blueprint $table) {
            $table->id();
            $table->string('location', 150);
            $table->string('type_trail', 50);
            $table->tinyInteger('difficulty');
            $table->string('name', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiking_trails');
    }
};
