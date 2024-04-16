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
        Schema::create('proveeidor', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50)->unique();
            $table->string('nif', 20)->unique();
            $table->string('email',50)->unique();
            $table->string('telefon',25)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveeidor');
    }
};
