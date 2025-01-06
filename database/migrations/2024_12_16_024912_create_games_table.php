<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->enum('type', ['individual', 'group']);
            $table->enum('status', ['activo', 'pausado', 'finalizado'])->default('activo');
            $table->text('rules')->nullable();
            $table->text('results')->nullable();
            $table->foreignId('coordinator_id')->unique()->nullable()->constrained('users')->onDelete('cascade'); // Coordinador (1:1)
            $table->timestamp('start_time')->nullable(); // Fecha de inicio
            $table->timestamp('end_time')->nullable(); // Fecha de fin
            $table->string('location')->nullable(); // Ubicación física del juego
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
