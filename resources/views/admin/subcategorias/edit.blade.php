<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categorias.index'),
    ],
    [
        'name' => $subcategoria->nombre,
    ],
]"> 


<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Editar subcategoria</h2>
    <div class="card">
        <form action="{{ route('admin.subcategorias.update', $subcategoria->id_subcategoria) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre de la subcategoria</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre de la categoría" required value="{{ old('nombre', $subcategoria->nombre) }}">
                @error('nombre')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
                
                
            {{-- descripcion --}}
            <div class="mb-4">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese una descripción">{{ old('descripcion', $subcategoria->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>
            
            {{-- select de la categoria a la que pertenece la subcategoria --}}

            <div class="mb-4">
                <label for="id_categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Seleccione la categoria</label>
                <select id="id_categoria" name="id_categoria" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <option value="" disabled>Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" {{ $categoria->id_categoria == $subcategoria->id_categoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>


            
            <div class="mb-4 flex gap-4 justify-end">
                {{-- Botón Cancelar (Rojo) --}}
                <a href="{{ route('admin.subcategorias.index') }}" class="flex items-center justify-center w-auto h-8 px-4 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancelar
                </a>
                
                {{-- Botón Actualizar (Verde) --}}
                <x-button class="flex items-center justify-center w-auto h-8 px-4 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
</div>

{{-- Verifica si hay una notificación de SweetAlert --}}
@if (session('swal'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({!! json_encode(session('swal')) !!});
        });
    </script>
@endif

</x-admin-layout>