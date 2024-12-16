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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable(); // Nombre
            $table->string('last_name')->nullable();  // Apellidos
            $table->string('university')->nullable(); // Universidad
            $table->string('role')->default('participant'); // Rol
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'university', 'role']);
        });
    }

};
