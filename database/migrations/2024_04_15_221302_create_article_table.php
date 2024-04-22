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
            $table->unsignedBigInteger("familiaId");
            $table->unsignedBigInteger("aulaId");
            $table->unsignedBigInteger("documentEntradaId");

            $table->foreign("familiaId")->references("id")->on("familia");
            $table->foreign("aulaId")->references("id")->on("aula");
            $table->foreign("documentEntradaId")->references("id")->on("documententrada");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['familiaId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['aulaId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign(['documentEntradaId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('article');
    }
};
