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
        Schema::create('aula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idEdifici");
            $table->unsignedBigInteger("idPis");
            $table->unsignedBigInteger('idAula');
            $table->string("descripcio",50);
            $table->timestamps();
            $table->unique(['idEdifici', 'idPis', 'idAula']);
            $table->foreign("idEdifici")->references("id")->on("edifici");
            $table->foreign("idPis")->references("id")->on("pis");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aula', function (Blueprint $table) {
            $table->dropForeign(['idEdifici']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('aula', function (Blueprint $table) {
            $table->dropForeign(['idPis']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('aula');
    }
};
