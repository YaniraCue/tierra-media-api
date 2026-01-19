<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('artifact_hero', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artifact_id')->constrained('artifacts');
            $table->foreignId('hero_id')->constrained('heroes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifact_hero');
    }
};
