<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
    ],
]">
    <x-slot name="action">
        <a href="{{ route('admin.categorias.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear Nueva categorias
        </a>
    </x-slot>

    <!-- DataTables con Tailwind y Botones de Exportación -->
    <div class="p-4 bg-white rounded-lg shadow-md">
        @if ($categorias->count() > 0)
            <div class="mb-4 flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-auto mb-4 md:mb-0">
                    <div id="familiasTable_length" class="flex items-center">
                        <label class="mr-2 text-sm font-medium text-gray-700">Mostrar</label>
                        <select id="entriesPerPage" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" onchange="changeItemsPerPage(this.value)">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="ml-2 text-sm font-medium text-gray-700">entradas</span>
                    </div>
                </div>
                <div class="w-full md:w-auto flex items-center space-x-2">
                    <div id="familiasTable_filter" class="relative w-full md:w-64">
                        <form id="searchForm" action="{{ route('admin.categorias.index') }}" method="GET">
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                            <input type="search" id="tableSearch" name="search" value="{{ request('search') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm pl-10" placeholder="Buscar...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </form>
                    </div>
                    <button id="exportExcel" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Excel
                    </button>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="familiasTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('admin.categorias.index', ['sort' => 'id_categoria', 'direction' => request('sort') === 'id_categoria' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'per_page' => request('per_page', 10)]) }}" class="flex items-center">
                                        ID
                                        @if(request('sort') === 'id_categoria')
                                            @if(request('direction') === 'asc')
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                            @else
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            @endif
                                        @endif
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('admin.categorias.index', ['sort' => 'nombre', 'direction' => request('sort') === 'nombre' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'per_page' => request('per_page', 10)]) }}" class="flex items-center">
                                        Nombre
                                        @if(request('sort') === 'nombre')
                                            @if(request('direction') === 'asc')
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                            @else
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            @endif
                                        @endif
                                    </a>
                                </div>
                            </th>
                            <!-- Columna de familia -->
                            <th scope="col" class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('admin.categorias.index', ['sort' => 'familia', 'direction' => request('sort') === 'familia' && request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search'), 'per_page' => request('per_page', 10)]) }}" class="flex items-center">
                                        Familia
                                        @if(request('sort') === 'familia')
                                            @if(request('direction') === 'asc')
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                            @else
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            @endif
                                        @endif
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 text-center">{{ $categoria->id_categoria }}</td>
                                <td class="px-6 py-4 text-center">{{ $categoria->nombre }}</td>
                                <td class="px-6 py-4 text-center">{{ $categoria->familia->nombre ?? 'Nombre no disponible' }}</td>

                                <td class="px-6 py-4 text-center space-x-2">
                                    <!-- Enlace de edición con icono y tooltip -->
                                    <a href="{{ route('admin.categorias.edit', $categoria->id_categoria) }}" class="text-blue-600 hover:text-blue-900" aria-label="Editar categoria {{ $categoria->nombre }}">
                                        <i class="fas fa-edit text-lg" data-tooltip-target="tooltip-edit-{{ $categoria->id_categoria }}" data-tooltip-placement="top"></i>
                                        <div id="tooltip-edit-{{ $categoria->id_categoria }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                            Editar categoria
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </a>
                                    
                                    <!-- Enlace de eliminación con icono y tooltip -->
                                    <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST" class="inline-block" id="delete-form-{{ $categoria->id_categoria }}">                              
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:text-red-900 delete-btn" data-id="{{ $categoria->id_categoria }}" aria-label="Eliminar categoria {{ $categoria->nombre }}">
                                            <i class="fas fa-trash text-lg" data-tooltip-target="tooltip-delete-{{ $categoria->id_categoria }}" data-tooltip-placement="top"></i>
                                            <div id="tooltip-delete-{{ $categoria->id_categoria }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                                Eliminar categoria
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex flex-col md:flex-row items-center justify-between">
                <div class="text-sm text-gray-700 mb-4 md:mb-0">
                    Mostrando {{ $categorias->firstItem() ?? 0 }} a {{ $categorias->lastItem() ?? 0 }} de {{ $categorias->total() }} entradas
                </div>
                <div class="flex justify-center">
                    {{ $categorias->appends([
                        'sort' => request('sort'),
                        'direction' => request('direction'),
                        'search' => request('search'),
                        'per_page' => request('per_page', 10)
                    ])->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No existe ninguna categoria registrada en el sistema.
                </div>
            </div>
        @endif
    </div>

    <!-- SheetJS (Excel Export) -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
    <!-- Flowbite para tooltips con Tailwind -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicialización de tooltips
            const tooltipElements = document.querySelectorAll('[data-tooltip-target]');
            tooltipElements.forEach(element => {
                const tooltipId = element.getAttribute('data-tooltip-target');
                const tooltip = document.getElementById(tooltipId);
                
                element.addEventListener('mouseenter', () => {
                    tooltip.classList.remove('invisible', 'opacity-0');
                    tooltip.classList.add('visible', 'opacity-100');
                });
                
                element.addEventListener('mouseleave', () => {
                    tooltip.classList.remove('visible', 'opacity-100');
                    tooltip.classList.add('invisible', 'opacity-0');
                });
            });

            // Envío automático del formulario al escribir en el campo de búsqueda
            const searchInput = document.getElementById('tableSearch');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchForm.submit();
                }, 500); // Esperar 500ms después de que el usuario deje de escribir
            });

            // Exportar a Excel
            document.getElementById('exportExcel').addEventListener('click', function() {
                const dataToExport = [];
                const table = document.getElementById('familiasTable');
                
                // Obtener encabezados
                const headers = [];
                table.querySelectorAll('thead th').forEach(th => {
                    // Extraer solo el texto principal, sin los íconos de ordenamiento
                    let headerText = th.textContent.trim();
                    if (headerText !== 'Acciones') {
                        headers.push(headerText);
                    }
                });
                dataToExport.push(headers);
                
                // Obtener datos
                table.querySelectorAll('tbody tr').forEach(row => {
                    const rowData = [];
                    Array.from(row.cells).forEach((cell, index) => {
                        // Excluir la columna de acciones
                        if (index < row.cells.length - 1) {
                            rowData.push(cell.textContent.trim());
                        }
                    });
                    dataToExport.push(rowData);
                });
                
                // Crear libro de Excel
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(dataToExport);
                XLSX.utils.book_append_sheet(wb, ws, 'Categorias');
                
                // Guardar archivo
                XLSX.writeFile(wb, 'Categorias_' + new Date().toISOString().slice(0, 10) + '.xlsx');
            });

            // SweetAlert para confirmación de eliminación
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const formId = `#delete-form-${this.getAttribute('data-id')}`;
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.querySelector(formId).submit();
                        }
                    });
                });
            });
        });

        // Función para cambiar el número de elementos por página
        function changeItemsPerPage(value) {
            const url = new URL(window.location);
            url.searchParams.set('per_page', value);
            window.location = url;
        }
    </script>

    @stack('scripts')
    
    @push('scripts')
        @if (session('swal'))
            <script>
                Swal.fire({!! json_encode(session('swal')) !!});
            </script>
        @endif
    @endpush

</x-admin-layout>