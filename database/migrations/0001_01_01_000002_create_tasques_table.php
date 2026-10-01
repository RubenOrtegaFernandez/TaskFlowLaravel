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
        Schema::create('tasques', function (Blueprint $table) {
            $table->id('id_tas')->autoIncrement();
            $table->enum('estat', ['pendent', 'en_curs', 'fet', 'revisat']);
            $table->string('nom_tas', 25);
            $table->string('descripcio', 255);
            $table->timestamp('data_inici');
            $table->timestamp('data_final')->nullable();
            $table->enum('prioritat', ['baixa','mitja', 'alta', 'urgent']);
            $table->string('categoria', 25);
            $table->foreignId('id_usr_creador')->nullable();
            $table->foreign('id_usr_creador')->references('id_correu')->on('usuaris');
            $table->foreignId('id_dep_assignat')->nullable();
            $table->foreign('id_dep_assignat')->references('id_dep')->on('departaments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasques');
    }
};
