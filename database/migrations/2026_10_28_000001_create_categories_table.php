<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $categoriesInicials = ['General', 'Disseny', 'Desenvolupament', 'Administració'];

    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_categoria');
            $table->string('nom_cat', 25)->unique();
        });

        $categories = array_map(function ($nom) {
            return ['nom_cat' => $nom];
        }, $this->categoriesInicials);

        DB::table('categories')->insert($categories);

        Schema::table('tasques', function (Blueprint $table) {
            $table->string('categoria', 25)->change();
        });
    }

    public function down(): void
    {
        $hiHaCategoriesNoves = DB::table('tasques')
            ->whereNotIn('categoria', $this->categoriesInicials)
            ->exists();

        if ($hiHaCategoriesNoves) {
            throw new \RuntimeException('No es pot revertir la migració mentre hi hagi tasques amb categories noves.');
        }

        Schema::table('tasques', function (Blueprint $table) {
            $table->enum('categoria', $this->categoriesInicials)->change();
        });

        Schema::dropIfExists('categories');
    }
};
