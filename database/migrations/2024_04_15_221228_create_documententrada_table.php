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
        Schema::create('documententrada', function (Blueprint $table) {
            $table->id();
            $table->date("data");
            $table->string("observacions",250);
            $table->unsignedBigInteger("ref")->unique();
            $table->string("url_pdf",75)->unique();
            $table->unsignedBigInteger("proveeidorId");
            
            $table->foreign("proveeidorId")->references("id")->on("proveeidor");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documententrada', function (Blueprint $table) {
            $table->dropForeign(['proveeidorId']); // Eliminamos la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('documententrada');
    }
};
