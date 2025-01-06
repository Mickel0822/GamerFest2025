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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->decimal('cost', 8, 2);
            $table->string('status')->default('pendiente'); // Estado del pago
            $table->string('team_name')->nullable();
            $table->string('payment_method')->nullable();// Método de pago (efectivo/comprobante)
            $table->string('payment_receipt')->nullable(); // Archivo de imagen (JPG)
            $table->unsignedInteger('round')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }

};
