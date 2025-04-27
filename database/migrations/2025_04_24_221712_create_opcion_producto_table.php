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
        Schema::create('opcion_producto', function (Blueprint $table) {
            $table->id('id_op');

            $table->foreignId('id_opcion')
                ->constrained('opcions', 'id_opcion')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // productos
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('valor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcion_producto');
    }
};
