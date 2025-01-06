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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade'); // Relación con juego
            $table->string('name'); // Nombre de la ronda
            $table->unsignedInteger('order'); // Orden de la ronda
            $table->timestamp('start_time')->nullable(); // Fecha de inicio
            $table->timestamp('end_time')->nullable(); // Fecha de fin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
