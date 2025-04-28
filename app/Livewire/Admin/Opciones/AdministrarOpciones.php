<?php

namespace App\Livewire\Admin\Opciones;

use Livewire\Component;
use App\Models\Opcion;
use Illuminate\Support\Collection;

class AdministrarOpciones extends Component
{
    public $opciones;
    public $modal = false;
    public $modalEliminar = false;
    public $modalTitulo = 'Nueva Opción';
    public $accion = 'crear';
    
    // Propiedades para la opción
    public $opcionId;
    public $nombre;
    public $tipo;
    
    // Propiedades para características
    public $caracteristicas = [];
    public $opcionSeleccionada = null;
    
    // Reglas de validación
    protected $rules = [
        'nombre' => 'required|min:3|max:50',
        'tipo' => 'required|integer|min:1|max:4',
        'caracteristicas' => 'required|array|min:1',
        'caracteristicas.*.valor' => 'required|max:50',
        'caracteristicas.*.descripcion' => 'required|max:100',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre de la opción es obligatorio.',
        'tipo.required' => 'El tipo de opción es obligatorio.',
        'caracteristicas.required' => 'Debe agregar al menos una característica.',
        'caracteristicas.min' => 'Debe agregar al menos una característica.',
        'caracteristicas.*.valor.required' => 'El valor de la característica es obligatorio.',
        'caracteristicas.*.descripcion.required' => 'La descripción de la característica es obligatoria.',
    ];

    public function mount()
    {
        $this->cargarOpciones();
        $this->inicializarCaracteristicas();
    }

    public function cargarOpciones()
    {
        $this->opciones = Opcion::with('caracteristicas')
            ->orderBy('id_opcion', 'desc')
            ->get();
    }

    public function inicializarCaracteristicas()
    {
        $this->caracteristicas = [
            ['valor' => '', 'descripcion' => '']
        ];
    }

    // Abrir modal para crear nueva opción
    public function abrirModalCrear()
    {
        $this->resetearFormulario();
        $this->modalTitulo = 'Nueva Opción';
        $this->accion = 'crear';
        $this->modal = true;
    }

    // Abrir modal para editar opción existente
    public function abrirModalEditar($opcionId)
    {
        $this->resetearFormulario();
        $this->modalTitulo = 'Editar Opción';
        $this->accion = 'editar';
        $this->opcionId = $opcionId;
        
        $opcion = Opcion::with('caracteristicas')->find($opcionId);
        $this->nombre = $opcion->nombre;
        $this->tipo = $opcion->tipo;
        
        // Cargar características existentes
        $this->caracteristicas = [];
        foreach ($opcion->caracteristicas as $caracteristica) {
            $this->caracteristicas[] = [
                'id' => $caracteristica->id,
                'valor' => $caracteristica->valor,
                'descripcion' => $caracteristica->descripcion,
            ];
        }
        
        $this->modal = true;
    }

    // Abrir modal de confirmación para eliminar
    public function confirmarEliminacion($opcionId)
    {
        $this->opcionSeleccionada = Opcion::find($opcionId);
        $this->modalEliminar = true;
    }

    // Guardar opción (crear o actualizar)
    public function guardar()
    {
        $this->validate();
        
        if ($this->accion === 'crear') {
            // Crear nueva opción
            $opcion = Opcion::create([
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
            ]);
            
            // Crear características asociadas
            foreach ($this->caracteristicas as $caracteristica) {
                $opcion->caracteristicas()->create([
                    'valor' => $caracteristica['valor'],
                    'descripcion' => $caracteristica['descripcion'],
                ]);
            }
            
            $this->dispatch('notify', ['mensaje' => 'Opción creada correctamente', 'tipo' => 'success']);
        } else {
            // Actualizar opción existente
            $opcion = Opcion::find($this->opcionId);
            $opcion->update([
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
            ]);
            
            // Manejo de características
            // Primero eliminamos las características existentes
            $opcion->caracteristicas()->delete();
            
            // Luego creamos las nuevas características
            foreach ($this->caracteristicas as $caracteristica) {
                $opcion->caracteristicas()->create([
                    'valor' => $caracteristica['valor'],
                    'descripcion' => $caracteristica['descripcion'],
                ]);
            }
            
            $this->dispatch('notify', ['mensaje' => 'Opción actualizada correctamente', 'tipo' => 'success']);
        }
        
        $this->resetearFormulario();
        $this->modal = false;
        $this->cargarOpciones();
    }

    // Eliminar opción
    public function eliminar()
    {
        $opcion = Opcion::find($this->opcionSeleccionada->id_opcion);
        
        // Eliminamos todas las características asociadas
        $opcion->caracteristicas()->delete();
        
        // Eliminamos la opción
        $opcion->delete();
        
        $this->dispatch('notify', ['mensaje' => 'Opción eliminada correctamente', 'tipo' => 'success']);
        $this->modalEliminar = false;
        $this->cargarOpciones();
    }

    // Agregar una nueva característica vacía al formulario
    public function agregarCaracteristica()
    {
        $this->caracteristicas[] = ['valor' => '', 'descripcion' => ''];
    }

    // Eliminar una característica del formulario
    public function eliminarCaracteristica($index)
    {
        if (count($this->caracteristicas) > 1) {
            unset($this->caracteristicas[$index]);
            $this->caracteristicas = array_values($this->caracteristicas);
        } else {
            $this->dispatch('notify', ['mensaje' => 'Debe tener al menos una característica', 'tipo' => 'error']);
        }
    }

    // Resetear formulario
    public function resetearFormulario()
    {
        $this->opcionId = null;
        $this->nombre = '';
        $this->tipo = '';
        $this->inicializarCaracteristicas();
        $this->resetErrorBag();
    }

    // Cerrar modal
    public function cerrarModal()
    {
        $this->modal = false;
        $this->modalEliminar = false;
    }

    public function render()
    {
        return view('livewire.admin.opciones.administrar-opciones');
    }
}