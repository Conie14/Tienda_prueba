<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //este seeder es para la tabla familia 

        $familias = [
            'Mascotas' => [
                'Alimentos' => [
                    ['nombre' => 'Alimento para perros', 'descripcion' => 'Alimento especialmente diseñado para la nutrición de perros.'],
                    ['nombre' => 'Alimento para gatos', 'descripcion' => 'Alimento especialmente formulado para gatos.'],
                    ['nombre' => 'Alimento para aves', 'descripcion' => 'Alimentos para mantener la salud de las aves.'],
                    ['nombre' => 'Alimento para peces', 'descripcion' => 'Nutrición adecuada para peces de agua dulce y salada.'],
                    ['nombre' => 'Snacks y premios', 'descripcion' => 'Deliciosos snacks y premios para consentir a tu mascota.'],
                    ['nombre' => 'Alimentos especiales', 'descripcion' => 'Alimentos especializados para mascotas con necesidades dietéticas especiales.'],
                ],
                'Accesorios' => [
                    ['nombre' => 'Comederos y bebederos', 'descripcion' => 'Accesorios para alimentar y dar de beber a tus mascotas.'],
                    ['nombre' => 'Collares y correas', 'descripcion' => 'Collares y correas para el paseo de tus mascotas.'],
                    ['nombre' => 'Camas y casas', 'descripcion' => 'Camas y casas cómodas para que tu mascota descanse.'],
                    ['nombre' => 'Transportadoras', 'descripcion' => 'Transportadoras para facilitar el traslado seguro de tu mascota.'],
                    ['nombre' => 'Jaulas y peceras', 'descripcion' => 'Jaulas y peceras para mascotas como aves y peces.'],
                    ['nombre' => 'Ropa para mascotas', 'descripcion' => 'Ropa y accesorios para mantener a tu mascota abrigada y a la moda.'],
                    ['nombre' => 'Juguetes', 'descripcion' => 'Juguetes para mantener a tu mascota entretenida y activa.'],
                ],
                'Salud y Bienestar' => [
                    ['nombre' => 'Medicamentos', 'descripcion' => 'Medicamentos para el tratamiento de diversas condiciones de salud.'],
                    ['nombre' => 'Antiparasitarios', 'descripcion' => 'Productos para prevenir y eliminar parásitos en tus mascotas.'],
                    ['nombre' => 'Vitaminas y suplementos', 'descripcion' => 'Suplementos nutricionales para mejorar la salud general de tu mascota.'],
                    ['nombre' => 'Cuidado dental', 'descripcion' => 'Productos para el cuidado dental y la higiene bucal de tus mascotas.'],
                    ['nombre' => 'Antipulgas', 'descripcion' => 'Tratamientos para el control de pulgas y otros parásitos.'],
                    ['nombre' => 'Productos veterinarios', 'descripcion' => 'Productos especializados para el cuidado veterinario de tu mascota.'],
                ],
                'Higiene' => [
                    ['nombre' => 'Champús y acondicionadores', 'descripcion' => 'Productos para el baño y cuidado del pelaje de tu mascota.'],
                    ['nombre' => 'Arena para gatos', 'descripcion' => 'Arena higiénica para el cuidado del arenero de tu gato.'],
                    ['nombre' => 'Pañales y alfombras', 'descripcion' => 'Pañales y alfombras para el cuidado de mascotas con necesidades especiales.'],
                    ['nombre' => 'Cepillos y peines', 'descripcion' => 'Cepillos y peines para mantener el pelaje de tu mascota en buen estado.'],
                    ['nombre' => 'Productos para el baño', 'descripcion' => 'Productos específicos para el baño de tus mascotas.'],
                    ['nombre' => 'Eliminadores de olores', 'descripcion' => 'Productos para eliminar malos olores de tus mascotas y su entorno.'],
                ],
                'Juguetes y Entretenimiento' => [
                    ['nombre' => 'Juguetes para perros', 'descripcion' => 'Juguetes diseñados para el entretenimiento de los perros.'],
                    ['nombre' => 'Juguetes para gatos', 'descripcion' => 'Juguetes para mantener a los gatos activos y divertidos.'],
                    ['nombre' => 'Rascadores', 'descripcion' => 'Rascadores para que tu gato se divierta y cuide sus garras.'],
                    ['nombre' => 'Pelotas y frisbees', 'descripcion' => 'Pelotas y frisbees para jugar y ejercitar a tu perro.'],
                    ['nombre' => 'Juguetes interactivos', 'descripcion' => 'Juguetes que estimulan mentalmente a tu mascota.'],
                    ['nombre' => 'Juguetes masticables', 'descripcion' => 'Juguetes para perros que ayudan a satisfacer su instinto de masticar.'],
                ],
                'Por tipo de mascota' => [
                    ['nombre' => 'Productos para perros', 'descripcion' => 'Productos específicamente diseñados para perros.'],
                    ['nombre' => 'Productos para gatos', 'descripcion' => 'Productos diseñados especialmente para el cuidado de gatos.'],
                    ['nombre' => 'Productos para aves', 'descripcion' => 'Productos para mantener a las aves saludables y felices.'],
                    ['nombre' => 'Productos para peces', 'descripcion' => 'Artículos específicos para el cuidado de los peces.'],
                    ['nombre' => 'Productos para roedores', 'descripcion' => 'Productos diseñados para roedores como conejos, cobayas y hámsteres.'],
                    ['nombre' => 'Productos para reptiles', 'descripcion' => 'Productos especializados para reptiles, como terrarios y alimentos.'],
                ],
            ],
            'Veterinaria' => [
                'Servicios Clínicos' => [
                    ['nombre' => 'Consulta general', 'descripcion' => 'Consulta médica general para tu mascota.'],
                    ['nombre' => 'Vacunación', 'descripcion' => 'Vacunas esenciales para la prevención de enfermedades.'],
                    ['nombre' => 'Desparasitación', 'descripcion' => 'Tratamientos para la eliminación de parásitos internos y externos.'],
                    ['nombre' => 'Cirugía', 'descripcion' => 'Servicios quirúrgicos para diversas condiciones de salud.'],
                    ['nombre' => 'Hospitalización', 'descripcion' => 'Servicio de hospitalización para mascotas que requieren atención constante.'],
                    ['nombre' => 'Emergencias 24h', 'descripcion' => 'Atención veterinaria de emergencia las 24 horas.'],
                    ['nombre' => 'Esterilización/Castración', 'descripcion' => 'Servicios de esterilización y castración para el control de la población animal.'],
                ],
                'Especialidades' => [
                    ['nombre' => 'Dermatología', 'descripcion' => 'Tratamientos especializados para enfermedades de la piel.'],
                    ['nombre' => 'Cardiología', 'descripcion' => 'Atención especializada para problemas cardíacos en mascotas.'],
                    ['nombre' => 'Odontología', 'descripcion' => 'Tratamientos odontológicos para mantener la salud dental de las mascotas.'],
                    ['nombre' => 'Oftalmología', 'descripcion' => 'Atención veterinaria especializada en enfermedades oculares.'],
                    ['nombre' => 'Oncología', 'descripcion' => 'Tratamientos especializados en cáncer y tumores en mascotas.'],
                    ['nombre' => 'Traumatología', 'descripcion' => 'Atención especializada en lesiones y fracturas.'],
                    ['nombre' => 'Neurología', 'descripcion' => 'Diagnóstico y tratamiento de trastornos neurológicos en mascotas.'],
                    ['nombre' => 'Geriatría', 'descripcion' => 'Atención médica especializada para mascotas mayores.'],
                ],
                'Diagnóstico' => [
                    ['nombre' => 'Análisis de laboratorio', 'descripcion' => 'Exámenes de laboratorio para diagnóstico de diversas enfermedades.'],
                    ['nombre' => 'Radiografía', 'descripcion' => 'Radiografías para detectar problemas óseos y otros trastornos.'],
                    ['nombre' => 'Ecografía', 'descripcion' => 'Ecografías para la evaluación interna de órganos y tejidos.'],
                    ['nombre' => 'Endoscopía', 'descripcion' => 'Procedimientos de diagnóstico con endoscopio para explorar cavidades internas.'],
                    ['nombre' => 'Electrocardiograma', 'descripcion' => 'Prueba para evaluar la actividad eléctrica del corazón.'],
                    ['nombre' => 'Tomografía', 'descripcion' => 'Examen diagnóstico avanzado para detectar enfermedades y lesiones.'],
                ],
                'Farmacia Veterinaria' => [
                    ['nombre' => 'Antibióticos', 'descripcion' => 'Medicamentos antibióticos para tratar infecciones.'],
                    ['nombre' => 'Antiparasitarios', 'descripcion' => 'Tratamientos para eliminar parásitos de mascotas.'],
                    ['nombre' => 'Antiinflamatorios', 'descripcion' => 'Medicamentos para reducir la inflamación y el dolor.'],
                    ['nombre' => 'Analgésicos', 'descripcion' => 'Medicamentos para aliviar el dolor en mascotas.'],
                    ['nombre' => 'Suplementos', 'descripcion' => 'Suplementos para mejorar la salud general de las mascotas.'],
                    ['nombre' => 'Medicamentos dermatológicos', 'descripcion' => 'Medicamentos para tratar afecciones dermatológicas.'],
                    ['nombre' => 'Productos oftálmicos', 'descripcion' => 'Productos para el cuidado de los ojos de tus mascotas.'],
                ],
                'Cuidado Preventivo' => [
                    ['nombre' => 'Planes de vacunación', 'descripcion' => 'Programas de vacunación para proteger a tu mascota de enfermedades.'],
                    ['nombre' => 'Control de parásitos', 'descripcion' => 'Tratamientos preventivos para controlar parásitos internos y externos.'],
                    ['nombre' => 'Chequeos periódicos', 'descripcion' => 'Chequeos regulares para garantizar la salud de tu mascota.'],
                    ['nombre' => 'Nutrición especializada', 'descripcion' => 'Asesoría en nutrición para mascotas con necesidades especiales.'],
                    ['nombre' => 'Microchip', 'descripcion' => 'Implantación de microchips para identificación de mascotas.'],
                    ['nombre' => 'Higiene dental', 'descripcion' => 'Servicios para mantener la salud dental de tu mascota.'],
                ],
                'Grooming' => [
                    ['nombre' => 'Baño terapéutico', 'descripcion' => 'Baños especiales para tratar problemas de la piel.'],
                    ['nombre' => 'Corte de pelo', 'descripcion' => 'Corte y arreglo del pelaje de tus mascotas.'],
                    ['nombre' => 'Corte de uñas', 'descripcion' => 'Corte y cuidado de las uñas de tus mascotas.'],
                    ['nombre' => 'Limpieza de oídos', 'descripcion' => 'Limpieza y cuidado de los oídos de tu mascota.'],
                    ['nombre' => 'Limpieza de glándulas anales', 'descripcion' => 'Limpieza de glándulas anales para evitar infecciones y mal olor.'],
                ],
            ],
        ];


        //entramos al arreglo de familias
        foreach ($familias as $familia => $categorias) {
            $familiaModel = \App\Models\Familia::create(['nombre' => $familia]);
        
            foreach ($categorias as $categoria => $subcategorias) {
                $categoriaModel = \App\Models\Categoria::create([
                    'nombre' => $categoria,
                    'id_familia' => $familiaModel->id,
                ]);
        
                foreach ($subcategorias as $subcategoria) {
                    \App\Models\Subcategoria::create([
                        'nombre' => $subcategoria['nombre'],
                        'descripcion' => $subcategoria['descripcion'],
                        'id_categoria' => $categoriaModel->id,
                    ]);
                }
            }
        }
        


    }
}
