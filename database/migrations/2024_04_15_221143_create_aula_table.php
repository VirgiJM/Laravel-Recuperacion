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
            $table->unsignedBigInteger("pisId");
            $table->unsignedBigInteger('codiAula');
            $table->string("descripcio", 50);
            $table->timestamps();
            $table->unique(['pisId', 'codiAula']);
            $table->foreign("pisId")->references("id")->on("pis");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aula', function (Blueprint $table) {
            $table->dropForeign(['pisId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('aula');
    }
};
