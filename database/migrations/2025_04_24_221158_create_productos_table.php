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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('imagen');
            $table->float('precio');
            
            // categorias
            $table->foreignId('id_subcategoria')
                ->constrained('subcategorias', 'id_subcategoria')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            //provedors
            //$table->foreignId('id_provedor')
            //    ->constrained('provedors', 'id_provedor')
            //    ->onDelete('cascade')
            //    ->onUpdate('cascade');
        


                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
