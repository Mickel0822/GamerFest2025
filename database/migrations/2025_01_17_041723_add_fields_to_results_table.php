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
        Schema::table('results', function (Blueprint $table) {
            $table->string('match_type')->default('individual')->after('round_id'); // Tipo de enfrentamiento
            $table->foreignId('player_one_id')->nullable()->after('match_type')->constrained('users')->onDelete('cascade'); // Jugador 1
            $table->foreignId('player_two_id')->nullable()->after('player_one_id')->constrained('users')->onDelete('cascade'); // Jugador 2
            $table->string('winner_type')->nullable()->after('player_two_id'); // Tipo de ganador
            $table->string('winner_id')->nullable()->after('winner_type'); // ID del ganador
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn(['match_type', 'player_one_id', 'player_two_id', 'winner_type', 'winner_id']);
        });
    }
};
