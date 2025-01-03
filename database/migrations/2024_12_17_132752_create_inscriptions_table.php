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
            $table->string('team_name')->nullable(); // Solo para juegos grupales
            $table->foreignId('member_1_id')->nullable()->constrained('users');
            $table->foreignId('member_2_id')->nullable()->constrained('users');
            $table->foreignId('member_3_id')->nullable()->constrained('users');
            $table->foreignId('member_4_id')->nullable()->constrained('users');
            $table->decimal('cost', 8, 2);
            $table->string('status')->default('pendiente'); // Estado del pago
            $table->string('payment_receipt')->nullable(); // Archivo de imagen (JPG)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }

};
