<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id('id_correu')->autoIncrement();
            $table->string('nom_usu',25);
            $table->string('correu', 255)->unique();
            $table->enum('rol_tipus', ['admin', 'cap', 'client']);
            $table->string('foto_perfil', 255)->default('img/default.png');
            $table->string('contrasenya', 255);
            $table->foreignId('id_dep')->nullable();
            $table->foreign('id_dep')->references('id_dep')->on('departaments');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuaris');
    }
};