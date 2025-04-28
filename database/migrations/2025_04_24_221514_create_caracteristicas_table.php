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
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id('id_caracteristica'); // Clave primaria con nombre específico
            $table->string('valor');
            $table->string('descripcion');
            // Definir correctamente el id_opcion como clave foránea
            $table->unsignedBigInteger('id_opcion');
            $table->foreign('id_opcion')->references('id_opcion')->on('opcions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};
