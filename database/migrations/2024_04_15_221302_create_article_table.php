<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->date("dataalta");
            $table->string("marca",75);
            $table->string("model",75);
            $table->string("descripcio",150);
            $table->date("databaixa")->nullable();
            $table->unsignedBigInteger("idFamilia");
            $table->unsignedBigInteger("idAula");
            $table->unsignedBigInteger("idDocumentEntrada");

            $table->foreign("idFamilia")->references("id")->on("familia");
            $table->foreign("idAula")->references("id")->on("aula");
            $table->foreign("idDocumentEntrada")->references("id")->on("documententrada");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['idFamilia']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['idAula']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['idDocumentEntrada']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('article');
    }
};
