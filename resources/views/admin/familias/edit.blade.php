<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.familias.index'),
    ],
    [
        'name' => $familia->nombre,
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Familia</h2>
    <div class="card">
        <form action="{{ route('admin.familias.update', $familia->id_familia) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre de la Familia</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre de la familia" required value="{{ old('nombre', $familia->nombre) }}">
            </div>

            <div class="mb-4 flex gap-4 justify-end">
                {{-- Botón Cancelar (Rojo) --}}
                <a href="{{ route('admin.familias.index') }}" class="flex items-center justify-center w-auto h-8 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancelar
                </a>
                
                {{-- Botón Actualizar (Verde) --}}
                <x-button class="flex items-center justify-center w-auto h-8 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
        Swal.fire({!! json_encode(session('swal')) !!});
    </script>
@endif

</x-admin-layout>
