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
        Schema::create('usuari', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('contrasenya', 100);
            $table->timestamp('validat')->nullable();
            $table->string('telefon', 25)->unique();
            $table->unsignedBigInteger("rolId");
            $table->date("baixa")->nullable();
            $table->foreign('rolId')->references('id')->on('rol');
            $table->string('token', 150)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuari', function (Blueprint $table) {
            $table->dropForeign(['rolId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('usuari');
    }
};
