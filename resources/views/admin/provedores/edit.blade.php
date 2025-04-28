<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Provedores',
        'route' => route('admin.provedores.index'),
    ],
    [
        'name' => $provedor->nombre,
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Editar provedor</h2>
    <div class="card">
        <form action="{{ route('admin.provedores.update', $provedor->id_provedor) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre del provedor</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre del provedor" required value="{{ old('nombre', $provedor->nombre) }}">
            </div>
            {{--telefono--}}
            <div class="mb-4">
                <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el teléfono del provedor" required value="{{ old('telefono', $provedor->telefono) }}">
            </div>
            {{--correo--}}
            <div class="mb-4">
                <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Correo</label>
                <input type="email" id="correo" name="correo" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el correo del provedor" required value="{{ old('correo', $provedor->email) }}">
            </div>

            {{--direccion--}}
            <div class="mb-4">
                <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese la dirección del provedor" required value="{{ old('direccion', $provedor->direccion) }}">
            </div>

            <div class="mb-4 flex gap-4 justify-end">
                {{-- Botón Cancelar (Rojo) --}}
                <a href="{{ route('admin.provedores.index') }}" class="flex items-center justify-center w-auto h-8 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
