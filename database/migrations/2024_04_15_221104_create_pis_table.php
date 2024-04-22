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
        Schema::create('pis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edificiId'); // Agregamos la columna para la clave foránea
            $table->integer("numPis");
            $table->unique(["edificiId", "numPis"]);
            $table->timestamps();

            // Definimos la clave foránea
            $table->foreign('edificiId')->references('id')->on('edifici');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pis', function (Blueprint $table) {
            $table->dropForeign(['edificiId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('pis');
    }
};
