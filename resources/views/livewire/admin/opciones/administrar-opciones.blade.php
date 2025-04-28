<div>
    <section class="card bg-white shadow-md rounded-lg p-6">
        <header class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Administrar Opciones
            </h1>
            <button wire:click="abrirModalCrear" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Nueva Opción
            </button>
        </header>

        <div class="space-y-4">
            @foreach ($opciones as $opcion)
                <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 mr-4 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                @switch($opcion->tipo)
                                    @case(1)
                                        <i class="fas fa-ruler text-lg"></i>
                                        @break
                                    @case(2)
                                        <i class="fas fa-palette text-lg"></i>
                                        @break
                                    @case(3)
                                        <i class="fas fa-venus-mars text-lg"></i>
                                        @break
                                    @case(4)
                                        <i class="fas fa-paw text-lg"></i>
                                        @break
                                    @default
                                        <i class="fas fa-cog text-lg"></i>
                                @endswitch
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    {{ $opcion->nombre }}
                                </h2>
                                <p class="text-sm text-gray-500">
                                    @switch($opcion->tipo)
                                        @case(1)
                                            Talla
                                            @break
                                        @case(2)
                                            Color
                                            @break
                                        @case(3)
                                            Sexo
                                            @break
                                        @case(4)
                                            Animal
                                            @break
                                        @default
                                            Tipo: {{ $opcion->tipo }}
                                    @endswitch
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button wire:click="abrirModalEditar({{ $opcion->id_opcion }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmarEliminacion({{ $opcion->id_opcion }})" class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Características de la opción -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Características:</h3>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach ($opcion->caracteristicas as $caracteristica)
                                @switch($opcion->tipo)
                                    @case(1)
                                        <!-- Talla -->
                                        <span class="bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ $caracteristica->valor }} - {{ $caracteristica->descripcion }}
                                        </span>
                                        @break
                                    @case(2)
                                        <!-- Color -->
                                        <div class="flex items-center bg-gray-50 rounded-full px-3 py-1">
                                            <span class="inline-block h-6 w-6 rounded-full border-2 border-gray-300 mr-2" 
                                                  style="background-color: {{ $caracteristica->valor }};">
                                            </span>
                                            <span class="text-sm">{{ $caracteristica->descripcion }}</span>
                                        </div>
                                        @break
                                    @case(3)
                                        <!-- Sexo -->
                                        <span class="bg-pink-100 text-pink-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ $caracteristica->valor }} - {{ $caracteristica->descripcion }}
                                        </span>
                                        @break
                                    @case(4)
                                        <!-- Animal -->
                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ $caracteristica->valor }} - {{ $caracteristica->descripcion }}
                                        </span>
                                        @break
                                    @default
                                        <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">
                                            {{ $caracteristica->valor }} - {{ $caracteristica->descripcion }}
                                        </span>
                                @endswitch
                            @endforeach
                        </div>
                        
                        @if($opcion->caracteristicas->isEmpty())
                            <p class="text-sm text-gray-500 italic">No hay características definidas</p>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @if($opciones->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-info-circle text-4xl mb-3"></i>
                    <p>No hay opciones registradas. Crea una nueva opción para empezar.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal para crear/editar opción -->
    @if($modal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="cerrarModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit.prevent="guardar">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-xl leading-6 font-bold text-gray-900 mb-4" id="modal-title">
                                    {{ $modalTitulo }}
                                </h3>
                                
                                <div class="mt-4 space-y-4">
                                    <!-- Nombre de la opción -->
                                    <div>
                                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la opción</label>
                                        <input wire:model="nombre" type="text" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Tipo de opción -->
                                    <div>
                                        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de opción</label>
                                        <select wire:model="tipo" id="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="">Seleccione un tipo</option>
                                            <option value="1">Talla</option>
                                            <option value="2">Color</option>
                                            <option value="3">Sexo</option>
                                            <option value="4">Animal</option>
                                        </select>
                                        @error('tipo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Características -->
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <label class="block text-sm font-medium text-gray-700">Características</label>
                                            <button type="button" wire:click="agregarCaracteristica" class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-plus mr-1"></i> Agregar
                                            </button>
                                        </div>
                                        
                                        @error('caracteristicas') <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                                        
                                        <div class="space-y-3">
                                            @foreach($caracteristicas as $index => $caracteristica)
                                                <div class="flex space-x-2 items-start" wire:key="caracteristica-{{ $index }}">
                                                    <div class="flex-grow">
                                                        <div class="flex space-x-2">
                                                            <div class="flex-1">
                                                                <input type="text" wire:model="caracteristicas.{{ $index }}.valor" 
                                                                    placeholder="{{ $tipo == 2 ? 'Código de color (ej: #FF0000)' : 'Valor' }}"
                                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                                @error("caracteristicas.{$index}.valor") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                            </div>
                                                            <div class="flex-1">
                                                                <input type="text" wire:model="caracteristicas.{{ $index }}.descripcion" 
                                                                    placeholder="Descripción"
                                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                                @error("caracteristicas.{$index}.descripcion") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        @if($tipo == 2 && isset($caracteristicas[$index]['valor']) && $caracteristicas[$index]['valor'])
                                                            <div class="mt-1 flex items-center">
                                                                <span class="inline-block h-4 w-4 rounded-full mr-1" style="background-color: {{ $caracteristicas[$index]['valor'] }};"></span>
                                                                <span class="text-xs text-gray-500">Previsualización</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" wire:click="eliminarCaracteristica({{ $index }})" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $accion === 'crear' ? 'Crear' : 'Actualizar' }}
                        </button>
                        <button type="button" wire:click="cerrarModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmación para eliminar -->
    @if($modalEliminar)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="cerrarModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Eliminar Opción
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    ¿Estás seguro de que deseas eliminar la opción "{{ $opcionSeleccionada ? $opcionSeleccionada->nombre : '' }}"? Esta acción no se puede deshacer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="eliminar" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Eliminar
                    </button>
                    <button type="button" wire:click="cerrarModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Script para notificaciones -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('notify', (data) => {
                // Asumiendo que tienes alguna biblioteca de notificaciones como toastr o sweetalert
                // Si no, puedes implementar tu propia solución de notificaciones
                if (window.toastr) {
                    toastr[data.tipo](data.mensaje);
                } else if (window.Swal) {
                    Swal.fire({
                        icon: data.tipo,
                        title: data.mensaje,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    alert(data.mensaje);
                }
            });
        });
    </script>
</div>