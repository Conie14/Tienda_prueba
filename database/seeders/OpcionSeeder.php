<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Opcion;

class OpcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear opciones para el producto
        $opciones =[
            [
                'nombre' => 'Talla',
                'tipo' => 1,
                'caracteristicas'=>[
                    [
                        'valor' => 'CH',
                        'descripcion' => 'Chico',
                    ],
                    [
                        'valor' => 'M',
                        'descripcion' => 'Mediano',
                    ],
                    [
                        'valor' => 'G',
                        'descripcion' => 'Grande',
                    ]
                ]
            ]
            ,
            [
                'nombre' => 'Color',
                'tipo' => 2,
                'caracteristicas'=>[
                    [
                        'valor' => '#000000',
                        'descripcion' => 'Negro'
                    ],
                    [
                        'valor' => '#ffffff',
                        'descripcion' => 'Blanco'
                    ]


                ]
            ],
            [
                'nombre' => 'Sexo',
                'tipo' => 3,
                'caracteristicas'=>[
                    [
                        'valor'=> 'H',
                        'descripcion' => 'Hembra'

                    ],
                    [
                        'valor'=> 'M',
                        'descripcion' => 'Macho'

                    ],
                ]
            ],
            [
                'nombre' => 'Animal',
                'tipo' => 4,
                'caracteristicas'=>[
                    [
                        'valor'=> 'P',
                        'descripcion' => 'Perros'

                    ],
                    [
                        'valor'=> 'A',
                        'descripcion' => 'Aves'

                    ],
                    [
                        'valor'=> 'G',
                        'descripcion' => 'Gatos'

                    ],
                    [
                        'valor'=> 'E',
                        'descripcion' => 'Exoticos'

                    ],
                ]
            ],
        ];


        foreach ($opciones as $opcion) {
            // Crear la opción
            $nuevaOpcion = Opcion::create([
                'nombre' => $opcion['nombre'],
                'tipo' => $opcion['tipo'],
            ]);

            // Crear las características asociadas a la opción
            foreach ($opcion['caracteristicas'] as $caracteristica) {
                $nuevaOpcion->caracteristicas()->create([
                    'valor' => $caracteristica['valor'],
                    'descripcion' => $caracteristica['descripcion'],
                ]);
            }
        }

    }
}
