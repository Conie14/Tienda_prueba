<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ],
]">
    <x-slot name="action">
        <a href="{{ route('admin.productos.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear Nuevo Producto
        </a>
    </x-slot>

    <!-- DataTables con Tailwind y Botones de Exportación -->
    <div class="p-4 bg-white rounded-lg shadow-md">
        @if ($productos->count() > 0)
            <div class="mb-4 flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-auto mb-4 md:mb-0">
                    <div id="productosTable_length" class="flex items-center">
                        <label class="mr-2 text-sm font-medium text-gray-700">Mostrar</label>
                        <select id="entriesPerPage"
                            class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ml-2 text-sm font-medium text-gray-700">entradas</span>
                    </div>
                </div>
                <div class="w-full md:w-auto flex items-center space-x-2">
                    <div id="productosTable_filter" class="relative w-full md:w-64">
                        <input type="search" id="tableSearch"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm pl-10"
                            placeholder="Buscar...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <button id="exportExcel"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Excel
                    </button>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="productosTable"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="id_producto">
                                <div class="flex items-center justify-center">
                                    ID
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="sku">
                                <div class="flex items-center justify-center">
                                    SKU
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="nombre">
                                <div class="flex items-center justify-center">
                                    Nombre
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            {{--descripcion--}}
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="descripcion">
                                <div class="flex items-center justify-center">
                                    Descripción
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="precio">
                                <div class="flex items-center justify-center">
                                    Precio
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    Imagen
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 text-center">{{ $producto->id_producto }}</td>
                                <td class="px-6 py-4 text-center">{{ $producto->sku }}</td>
                                <td class="px-6 py-4 text-center">{{ $producto->nombre }}</td>
                                <td class="px-6 py-4 text-center">{{ $producto->descripcion }}</td>
                                {{-- Precio --}}
                                <td class="px-6 py-4 text-center">{{ number_format($producto->precio, 2) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-16 w-16 object-cover mx-auto rounded">
                                </td>
                                {{-- Acciones --}}
                                <td class="px-6 py-4 text-center space-x-2">
                                    <!-- Enlace de edición con icono y tooltip -->
                                    <a href="{{ route('admin.productos.edit', $producto->id_producto) }}"
                                        class="text-blue-600 hover:text-blue-900"
                                        aria-label="Editar {{ $producto->nombre }}">
                                        <i class="fas fa-edit text-lg"
                                            data-tooltip-target="tooltip-edit-{{ $producto->id_producto }}"
                                            data-tooltip-placement="top"></i>
                                        <div id="tooltip-edit-{{ $producto->id_producto }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                            Editar 
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </a>

                                    <!-- Enlace de eliminación con icono y tooltip -->
                                    <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}"
                                        method="POST" class="inline-block" id="delete-form-{{ $producto->id_producto }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:text-red-900 delete-btn"
                                            data-id="{{ $producto->id_producto }}"
                                            aria-label="Eliminar {{ $producto->nombre }}">
                                            <i class="fas fa-trash text-lg"
                                                data-tooltip-target="tooltip-delete-{{ $producto->id_producto }}"
                                                data-tooltip-placement="top"></i>
                                            <div id="tooltip-delete-{{ $producto->id_producto }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                                Eliminar
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
                    Mostrando <span id="showingStart">1</span> a <span id="showingEnd">10</span> de <span
                        id="totalEntries">{{ $productos->total() }}</span> entradas
                </div>
                {{ $productos->links() }}
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Alerta!</span> No existe ningún producto registrado en el sistema.
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
            // Inicialización de la tabla personalizada con Tailwind
            const table = document.getElementById('productosTable');
            const tableBody = table.querySelector('tbody');
            const searchInput = document.getElementById('tableSearch');
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const showingStart = document.getElementById('showingStart');
            const showingEnd = document.getElementById('showingEnd');
            const totalEntries = document.getElementById('totalEntries');

            let currentPage = 0;
            let entriesPerPage = parseInt(entriesPerPageSelect.value);
            let sortColumn = 'id_producto';
            let sortDirection = 'asc';
            let allRows = Array.from(tableBody.querySelectorAll('tr'));
            let filteredRows = [...allRows];

            // Inicializar tooltips
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

            // Función para ordenar filas
            function sortTable(column) {
                if (sortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortColumn = column;
                    sortDirection = 'asc';
                }

                // Actualizar iconos de ordenamiento
                document.querySelectorAll('.sort-icon').forEach(icon => {
                    icon.innerHTML = '';
                });

                const sortIcon = document.querySelector(`th[data-sort="${column}"] .sort-icon`);
                if (sortIcon) {
                    sortIcon.innerHTML = sortDirection === 'asc' ?
                        '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>' :
                        '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                }

                // Ordenar filas (solo para la tabla actual, ya que la paginación se maneja con Laravel)
                const columnIndex = Array.from(table.querySelectorAll('th')).findIndex(th => th.getAttribute(
                    'data-sort') === column);
                if (columnIndex !== -1) {
                    filteredRows.sort((a, b) => {
                        const aValue = a.cells[columnIndex].textContent.trim();
                        const bValue = b.cells[columnIndex].textContent.trim();

                        if (!isNaN(aValue) && !isNaN(bValue)) {
                            return sortDirection === 'asc' ?
                                parseFloat(aValue) - parseFloat(bValue) :
                                parseFloat(bValue) - parseFloat(aValue);
                        } else {
                            return sortDirection === 'asc' ?
                                aValue.localeCompare(bValue) :
                                bValue.localeCompare(aValue);
                        }
                    });
                }

                renderTable();
            }

            // Función para filtrar filas (búsqueda local)
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                filteredRows = allRows.filter(row => {
                    return Array.from(row.cells).some(cell => {
                        return cell.textContent.toLowerCase().includes(searchTerm);
                    });
                });

                renderTable();
                updateShowing();
            }

            // Función para actualizar la información de "Mostrando X a Y de Z entradas"
            function updateShowing() {
                const start = filteredRows.length > 0 ? 1 : 0;
                const end = filteredRows.length;
                showingStart.textContent = start;
                showingEnd.textContent = end;
                totalEntries.textContent = end;
            }

            // Función para renderizar tabla (solo ordenamiento local)
            function renderTable() {
                // Limpiar tabla
                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }

                // Agregar filas filtradas y ordenadas
                filteredRows.forEach(row => {
                    tableBody.appendChild(row);
                });
            }

            // Exportar a Excel
            document.getElementById('exportExcel').addEventListener('click', function() {
                const dataToExport = [];

                // Obtener encabezados
                const headers = [];
                table.querySelectorAll('thead th').forEach(th => {
                    const headerText = th.textContent.trim();
                    if (headerText !== 'Acciones' && headerText !== 'Imagen') {
                        headers.push(headerText);
                    }
                });
                dataToExport.push(headers);

                // Obtener datos
                filteredRows.forEach(row => {
                    const rowData = [];
                    Array.from(row.cells).forEach((cell, index) => {
                        // Excluir la columna de acciones e imagen
                        if (index < row.cells.length - 2 || index === row.cells.length - 3) {
                            rowData.push(cell.textContent.trim());
                        }
                    });
                    dataToExport.push(rowData);
                });

                // Crear libro de Excel
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(dataToExport);
                XLSX.utils.book_append_sheet(wb, ws, 'Productos');

                // Guardar archivo
                XLSX.writeFile(wb, 'Productos_' + new Date().toISOString().slice(0, 10) + '.xlsx');
            });

            // Evento de cambio en la cantidad de entradas por página
            entriesPerPageSelect.addEventListener('change', function() {
                // Crear URL con nuevo parámetro
                const url = new URL(window.location.href);
                url.searchParams.set('perPage', this.value);
                window.location.href = url.toString();
            });

            // Evento de búsqueda
            searchInput.addEventListener('input', filterTable);

            // Configurar ordenamiento
            document.querySelectorAll('th[data-sort]').forEach(th => {
                th.addEventListener('click', () => {
                    sortTable(th.getAttribute('data-sort'));
                });
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El producto ha sido eliminado correctamente.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            document.querySelector(formId).submit();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cancelado',
                                text: 'El producto no ha sido eliminado.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });

            // Inicializar tabla con ordenamiento local
            sortTable('id_producto');
            updateShowing();
        });
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