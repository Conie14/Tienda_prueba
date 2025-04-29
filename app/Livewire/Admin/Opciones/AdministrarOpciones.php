<?php

namespace App\Livewire\Admin\Opciones;

use Livewire\Component;
use App\Models\Opcion;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\Log;

class AdministrarOpciones extends Component
{
    public $opciones = [];
    public $openModal = false;

    public $nuevaOpcion = [
        'nombre' => '',
        'tipo' => 1,
        'caracteristicas' => [
            ['valor' => '', 'descripcion' => '']
        ]
    ];

    public function mount()
    {
        $this->cargarOpciones();
    }

    public function render()
    {
        return view('livewire.admin.opciones.administrar-opciones');
    }

    public function cargarOpciones()
    {
        $this->opciones = Opcion::with('caracteristicas')->get();
    }

    public function openModal()
    {
        $this->resetFormulario();
        $this->openModal = true;
    }

    public function closeModal()
    {
        $this->resetFormulario();
        $this->openModal = false;
    }

    public function agregarCaracteristica()
    {
        $this->nuevaOpcion['caracteristicas'][] = ['valor' => '', 'descripcion' => ''];
    }

    public function eliminarCaracteristica($index)
    {
        unset($this->nuevaOpcion['caracteristicas'][$index]);
        $this->nuevaOpcion['caracteristicas'] = array_values($this->nuevaOpcion['caracteristicas']);
    }

    public function guardarOpcion()
    {
        $this->validate([
            'nuevaOpcion.nombre' => 'required|min:2',
            'nuevaOpcion.tipo' => 'required|numeric|between:1,4',
            'nuevaOpcion.caracteristicas' => 'required|array|min:1',
            'nuevaOpcion.caracteristicas.*.valor' => 'required',
            'nuevaOpcion.caracteristicas.*.descripcion' => 'required',
        ]);

        try {
            $opcion = Opcion::create([
                'nombre' => $this->nuevaOpcion['nombre'],
                'tipo' => $this->nuevaOpcion['tipo'],
            ]);

            foreach ($this->nuevaOpcion['caracteristicas'] as $caracteristica) {
                Caracteristica::create([
                    'id_opcion' => $opcion->id_opcion,
                    'valor' => $caracteristica['valor'],
                    'descripcion' => $caracteristica['descripcion'],
                ]);
            }

            $this->closeModal();
            $this->cargarOpciones();
            session()->flash('message', 'Opción creada correctamente.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Error al guardar la opción.');
        }
    }

    public function resetFormulario()
    {
        $this->nuevaOpcion = [
            'nombre' => '',
            'tipo' => 1,
            'caracteristicas' => [
                ['valor' => '', 'descripcion' => '']
            ]
        ];
    }
}
