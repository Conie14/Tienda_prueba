```blade
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
        'name' => 'Crear Nueva subcategorias',
        'route' => route('admin.subcategorias.create'),
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nueva subcategorias</h2>
    <div class="card">
        <form action="{{ route('admin.subcategorias.store') }}" method="POST" class="mt-4">
            @csrf
            
            <div class="mb-4">
                <label for="id_categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Seleccione la categoria</label>

                <select id="id_categoria" name="id_categoria" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <option value="" disabled selected>Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror

            </div>
            
            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre de la categoría</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre de la categoría" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- descripcion --}}
            <div class="mb-4">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese una descripción">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="mb-4">
                <x-button class="flex items-center justify-center w-full h-10 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
</div>

{{-- Verifica si hay una notificación de SweetAlert --}}
@if (session('swal'))
    <!-- Cargar SweetAlert2 solo si el mensaje existe -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({!! json_encode(session('swal')) !!});
        });
    </script>
@endif

</x-admin-layout>
```