<div>
    <section class="card bg-white shadow-md rounded-lg p-6">
        <!-- Notification message -->
        @if (session()->has('message'))
            <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
        
        @if (session()->has('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <header class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Administrar Opciones
            </h1>
            <button wire:click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
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
                                    ID: {{ $opcion->id_opcion }} | Tipo: {{ $opcion->tipo }}
                                </p>
                            </div>
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
                    <i class="fas fa-info-circle text-2xl mb-2"></i>
                    <p>No hay opciones registradas. Crea una nueva opción para empezar.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal con Livewire -->
    @if($openModal != false)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                Crear Nueva Opción
                            </h3>
                            <div class="mt-4">
                                <form wire:submit.prevent="guardarOpcion">
                                    <div class="grid gap-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">
                                                Nombre
                                            </label>
                                            <input wire:model.defer="nuevaOpcion.nombre" placeholder="Nombre de la opción" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                            @error('nuevaOpcion.nombre') 
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm text-gray-700 mb-1">
                                                Tipo
                                            </label>
                                            <select wire:model.defer="nuevaOpcion.tipo" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="1">Talla</option>
                                                <option value="2">Color</option>
                                                <option value="3">Sexo</option>
                                                <option value="4">Animal</option>
                                            </select>
                                            @error('nuevaOpcion.tipo') 
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                        
                                        <div class="pt-4 border-t border-gray-200">
                                            <div class="mb-3">
                                                <label class="block font-medium text-sm text-gray-700">
                                                    Valores
                                                </label>
                                            </div>
                                            
                                            <!-- Importante: wire:key garantiza que Livewire sepa qué elementos actualizar -->
                                            @foreach ($nuevaOpcion['caracteristicas'] as $index => $caracteristica)
                                                <div class="flex items-center mb-2" wire:key="caracteristica-{{ $index }}">
                                                    <input type="text" wire:model.defer="nuevaOpcion.caracteristicas.{{ $index }}.valor" placeholder="Valor" class="w-1/3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2" />
                                                    <input type="text" wire:model.defer="nuevaOpcion.caracteristicas.{{ $index }}.descripcion" placeholder="Descripción" class="w-2/3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                                </div>
                                                @error('nuevaOpcion.caracteristicas.'.$index.'.valor') 
                                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                                                @enderror
                                                @error('nuevaOpcion.caracteristicas.'.$index.'.descripcion') 
                                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                                                @enderror
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="guardarOpcion" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button wire:click="closeModal" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>