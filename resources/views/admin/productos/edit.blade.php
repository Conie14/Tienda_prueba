<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.productos.index'),
    ],
    [
        'name' => $producto->nombre,
    ],
]">

<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Editar Producto</h2>
    <div class="card">
        <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">SKU del producto</label>
                <input type="text" id="sku" name="sku" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el SKU del producto" required value="{{ old('sku', $producto->sku) }}">
                @error('sku')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre del producto</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el nombre del producto" required value="{{ old('nombre', $producto->nombre) }}">
                @error('nombre')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese una descripción">{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Precio</label>
                <input type="number" id="precio" name="precio" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Ingrese el precio" required value="{{ old('precio', $producto->precio) }}">
                @error('precio')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Select de la subcategoria --}}
            <div class="mb-4">
                <label for="id_subcategoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Seleccione la subcategoría</label>
                <select id="id_subcategoria" name="id_subcategoria" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <option value="" disabled>Seleccione una subcategoría</option>
                    @foreach ($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id_subcategoria }}" {{ $subcategoria->id_subcategoria == $producto->id_subcategoria ? 'selected' : '' }}>{{ $subcategoria->nombre }}</option>
                    @endforeach
                </select>
                
                @error('id_subcategoria')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Imagen del producto --}}
            <div class="mb-4">
                <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Imagen del producto</label>
                <input type="file" id="imagen" name="imagen" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('imagen')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
                @if($producto->imagen)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen del producto" class="w-32 h-32 object-cover">
                    </div>
                @endif
            </div>

            <div class="mb-4 flex gap-4 justify-end">
                {{-- Botón Cancelar (Rojo) --}}
                <a href="{{ route('admin.productos.index') }}" class="flex items-center justify-center w-auto h-8 px-4 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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