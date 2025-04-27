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
            $table->id('id_cv');
            //caracteristica
            $table->foreignId('id_caracteristica')
                ->constrained('caracteristicas', 'id_caracteristica')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //variante
            $table->foreignId('id_variante')
                ->constrained('variantes', 'id_variante')
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
