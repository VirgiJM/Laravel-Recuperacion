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
        Schema::create('gestiona', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idAula");
            $table->unsignedBigInteger("idUsuari");
            $table->foreign("idAula")->references("id")->on("aula");
            $table->foreign("idUsuari")->references("id")->on("usuari");
            $table->unique(['idAula', 'idUsuari']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestiona', function (Blueprint $table) {
            $table->dropForeign(['idAula']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('gestiona', function (Blueprint $table) {
            $table->dropForeign(['idUsuari']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('gestiona');
    }
};
