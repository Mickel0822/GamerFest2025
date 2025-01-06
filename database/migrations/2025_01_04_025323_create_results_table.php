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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade'); // Relación con juego
            $table->foreignId('round_id')->nullable()->constrained('rounds')->onDelete('cascade'); // Relación con ronda
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Relación con usuario
            $table->string('team_name')->nullable(); // Nombre del equipo (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
