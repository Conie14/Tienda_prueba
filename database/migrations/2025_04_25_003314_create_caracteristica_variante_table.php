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
        Schema::create('caracteristica_variante', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_caracteristica');
            $table->foreign('id_caracteristica')
                  ->references('id_caracteristica')
                  ->on('caracteristicas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->unsignedBigInteger('id_variante');
            $table->foreign('id_variante')
                  ->references('id_variante')  // Asegúrate de que esta es la clave primaria correcta en la tabla variantes
                  ->on('variantes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristica_variante');
    }
};