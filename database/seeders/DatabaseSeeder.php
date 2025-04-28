<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Provedor;
use Illuminate\Support\Facades\Storage;
use App\Models\Familia;
use App\Models\Opcion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Eliminar el directorio y su contenido, si existe
        if (Storage::disk('public')->exists('productos')) {
            Storage::disk('public')->deleteDirectory('productos');
        }

        // Crear el directorio "productos" en el disco público
        Storage::disk('public')->makeDirectory('productos');

        // Llamar los seeders
        $this->call([
            FamiliaSeeder::class,
            OpcionSeeder::class,
        ]);

        // Llamar los factories
        Provedor::factory(10)->create();
        Producto::factory(10)->create();
    }
}
