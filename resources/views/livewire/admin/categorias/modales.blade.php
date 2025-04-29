<!-- Modal Principal para Crear/Editar Categorías -->
<div x-show="modal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-on:click="cerrarModal()"></div>

        <div class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ $modalTitulo }}
                </h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" x-on:click="cerrarModal()">
                    <span class="sr-only">Cerrar</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form wire:submit.prevent="guardar">
                <div class="space-y-4">
                    <!-- Nombre de la categoría -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input wire:model="nombre" type="text" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Descripción de la categoría -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea wire:model="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"></textarea>
                        @error('descripcion') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado de la categoría -->
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        @error('estado') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Categoría padre (si aplica) -->
                    <div>
                        <label for="categoria_padre_id" class="block text-sm font-medium text-gray-700">Categoría Padre (opcional)</label>
                        <select wire:model="categoria_padre_id" id="categoria_padre_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">-- Ninguna --</option>
                            @foreach ($categoriasPadre as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_padre_id') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" x-on:click="cerrarModal()">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmación para Eliminar -->
<div x-show="modalEliminar" x-cloak class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-on:click="cerrarModal()"></div>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <i class="text-red-600 fas fa-exclamation-triangle"></i>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Eliminar Categoría
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            ¿Estás seguro de que deseas eliminar la categoría <span class="font-semibold">{{ $categoriaSeleccionada ? $categoriaSeleccionada->nombre : '' }}</span>? Esta acción no se puede deshacer.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button wire:click="eliminar" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Eliminar
                </button>
                <button x-on:click="cerrarModal()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>