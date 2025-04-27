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
        'name' => 'Crear Nueva categorias',
        'route' => route('admin.categorias.create'),
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nueva categoría</h2>
    <div class="card">
        <form action="{{ route('admin.categorias.store') }}" method="POST" class="mt-4">
            @csrf
            
            <div class="mb-4">
                <label for="id_familia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Seleccione la familia</label>
                {{-- select de la familia a la que pertenece la categoria --}}
                <select id="id_familia" name="id_familia" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <option value="" disabled selected>Seleccione una familia</option>
                    @foreach ($familias as $familia)
                        <option value="{{ $familia->id_familia }}">{{ $familia->nombre }}</option>
                    @endforeach
                </select>
                @error('id_familia')
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