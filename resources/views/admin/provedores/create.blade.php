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
        'name' => 'Crear Nuevo proveedor',
        'route' => route('admin.provedores.create'),
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Crear Nuevo proveedor</h2>
    <div class="card">
        <form action="{{ route('admin.provedores.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre del proveedor</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre de la familia" required>
            </div>
            {{--telefono--}}
            <div class="mb-4">
                <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el teléfono del proveedor" required>
            </div>
            {{--email--}}
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Email</label>
                <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el email del proveedor" required>
            </div>
            {{--direccion--}}
            <div class="mb-4">
                <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese la dirección del proveedor" required>
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
        Swal.fire({!! json_encode(session('swal')) !!});
    </script>
@endif

</x-admin-layout>
