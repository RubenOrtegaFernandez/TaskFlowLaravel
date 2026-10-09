<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departaments', function (Blueprint $table) {
            $table->id('id_dep');
            $table->string('nom', 25);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pistes');
    }
};