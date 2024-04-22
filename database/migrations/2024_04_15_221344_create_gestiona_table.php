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
            $table->unsignedBigInteger("aulaId");
            $table->unsignedBigInteger("usuariId");
            $table->foreign("aulaId")->references("id")->on("aula");
            $table->foreign("usuariId")->references("id")->on("usuari")->onDelete("cascade");
            $table->unique(['aulaId', 'usuariId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestiona', function (Blueprint $table) {
            $table->dropForeign(['aulaId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('gestiona', function (Blueprint $table) {
            $table->dropForeign(['usuariId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('gestiona');
    }
};
