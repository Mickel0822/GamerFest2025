<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del juego
            $table->enum('type', ['individual', 'group']); // Tipo de juego
            $table->enum('status', ['activo', 'pausado', 'finalizado'])->default('activo'); // Estado
            $table->text('rules')->nullable(); // Reglas del juego
            $table->text('results')->nullable(); // Resultados (JSON o texto)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
