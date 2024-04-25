<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('rol', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50)->unique();
            $table->timestamps();
        });

        // DB:: es para acceder a una tabla sin su nombre.
        DB::table("rol")->insert(["nom"=>"Consultor"]);
        DB::table("rol")->insert(["nom"=>"Gestor"]);
        DB::table("rol")->insert(["nom"=>"Administrador"]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};
