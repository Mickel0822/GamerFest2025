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
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade'); // Relación con juegos
            $table->foreignId('round_id')->constrained('rounds')->onDelete('cascade'); // Relación con rondas
            $table->foreignId('player_one_id')->nullable()->constrained('inscriptions')->onDelete('cascade'); // Relación con inscripción del jugador/equipo 1
            $table->foreignId('player_two_id')->nullable()->constrained('inscriptions')->onDelete('cascade'); // Relación con inscripción del jugador/equipo 2
            $table->string('winner_type')->nullable(); // Tipo de ganador ('player', 'team')
            $table->foreignId('winner_id')->nullable()->constrained('inscriptions')->onDelete('cascade'); // Relación con inscripción del ganador
            $table->string('match_type')->default('individual'); // Tipo de enfrentamiento ('individual', 'group')
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
