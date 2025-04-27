<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
    ],
]">
    <x-slot name="action">
        <a href="{{ route('admin.familias.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Crear Nueva Familia
        </a>
    </x-slot>

    <!-- DataTables con Tailwind y Botones de Exportación -->
    <div class="p-4 bg-white rounded-lg shadow-md">
        @if ($familias->count() > 0)
            <div class="mb-4 flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-auto mb-4 md:mb-0">
                    <div id="familiasTable_length" class="flex items-center">
                        <label class="mr-2 text-sm font-medium text-gray-700">Mostrar</label>
                        <select id="entriesPerPage" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ml-2 text-sm font-medium text-gray-700">entradas</span>
                    </div>
                </div>
                <div class="w-full md:w-auto flex items-center space-x-2">
                    <div id="familiasTable_filter" class="relative w-full md:w-64">
                        <input type="search" id="tableSearch" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm pl-10" placeholder="Buscar...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
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
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="id_familia">
                                <div class="flex items-center justify-center">
                                    ID
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center cursor-pointer" data-sort="nombre">
                                <div class="flex items-center justify-center">
                                    Nombre
                                    <span class="sort-icon ml-1"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($familias as $familia)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 text-center">{{ $familia->id_familia }}</td>
                                <td class="px-6 py-4 text-center">{{ $familia->nombre }}</td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <!-- Enlace de edición con icono y tooltip -->
                                    <a href="{{ route('admin.familias.edit', $familia->id_familia) }}" class="text-blue-600 hover:text-blue-900" aria-label="Editar Familia {{ $familia->nombre }}">
                                        <i class="fas fa-edit text-lg" data-tooltip-target="tooltip-edit-{{ $familia->id_familia }}" data-tooltip-placement="top"></i>
                                        <div id="tooltip-edit-{{ $familia->id_familia }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                            Editar Familia
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </a>
                                    
                                    <!-- Enlace de eliminación con icono y tooltip -->
                                    <form action="{{ route('admin.familias.destroy', $familia->id_familia) }}" method="POST" class="inline-block" id="delete-form-{{ $familia->id_familia }}">                              
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:text-red-900 delete-btn" data-id="{{ $familia->id_familia }}" aria-label="Eliminar Familia {{ $familia->nombre }}">
                                            <i class="fas fa-trash text-lg" data-tooltip-target="tooltip-delete-{{ $familia->id_familia }}" data-tooltip-placement="top"></i>
                                            <div id="tooltip-delete-{{ $familia->id_familia }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                                Eliminar Familia
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
                    Mostrando <span id="showingStart">1</span> a <span id="showingEnd">10</span> de <span id="totalEntries">{{ $familias->count() }}</span> entradas
                </div>
                <div class="flex justify-center" id="tableNavigation">
                    <!-- Aquí se generará la paginación de forma dinámica -->
                </div>
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No existe ninguna familia registrada en el sistema.
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
            const table = document.getElementById('familiasTable');
            const tableBody = table.querySelector('tbody');
            const searchInput = document.getElementById('tableSearch');
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const showingStart = document.getElementById('showingStart');
            const showingEnd = document.getElementById('showingEnd');
            const totalEntries = document.getElementById('totalEntries');
            const tableNavigation = document.getElementById('tableNavigation');

            let currentPage = 0;
            let entriesPerPage = parseInt(entriesPerPageSelect.value);
            let sortColumn = 'id_familia';
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
                    sortIcon.innerHTML = sortDirection === 'asc' 
                        ? '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>' 
                        : '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                }

                // Ordenar filas
                const columnIndex = Array.from(table.querySelectorAll('th')).findIndex(th => th.getAttribute('data-sort') === column);
                if (columnIndex !== -1) {
                    filteredRows.sort((a, b) => {
                        const aValue = a.cells[columnIndex].textContent.trim();
                        const bValue = b.cells[columnIndex].textContent.trim();
                        
                        if (!isNaN(aValue) && !isNaN(bValue)) {
                            return sortDirection === 'asc' 
                                ? parseInt(aValue) - parseInt(bValue) 
                                : parseInt(bValue) - parseInt(aValue);
                        } else {
                            return sortDirection === 'asc' 
                                ? aValue.localeCompare(bValue) 
                                : bValue.localeCompare(aValue);
                        }
                    });
                }

                renderTable();
            }

            // Función para filtrar filas
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                filteredRows = allRows.filter(row => {
                    return Array.from(row.cells).some(cell => {
                        return cell.textContent.toLowerCase().includes(searchTerm);
                    });
                });

                currentPage = 0;
                renderTable();
                updatePagination();
            }

            // Función para generar paginación
            function updatePagination() {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
                tableNavigation.innerHTML = '';

                // Construir la paginación
                const paginationUl = document.createElement('ul');
                paginationUl.className = 'inline-flex items-center -space-x-px';

                // Botón Anterior
                const prevButton = document.createElement('li');
                prevButton.innerHTML = `
                    <button class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 ${currentPage === 0 ? 'cursor-not-allowed opacity-50' : ''}">
                        <span class="sr-only">Anterior</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                `;
                if (currentPage > 0) {
                    prevButton.querySelector('button').addEventListener('click', () => {
                        currentPage--;
                        renderTable();
                        updatePagination();
                    });
                }
                paginationUl.appendChild(prevButton);

                // Números de página
                for (let i = 0; i < totalPages; i++) {
                    const pageItem = document.createElement('li');
                    pageItem.innerHTML = `
                        <button class="px-3 py-2 leading-tight ${currentPage === i 
                            ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' 
                            : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700'}">
                            ${i + 1}
                        </button>
                    `;
                    pageItem.querySelector('button').addEventListener('click', () => {
                        currentPage = i;
                        renderTable();
                        updatePagination();
                    });
                    paginationUl.appendChild(pageItem);
                }

                // Botón Siguiente
                const nextButton = document.createElement('li');
                nextButton.innerHTML = `
                    <button class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 ${currentPage === totalPages - 1 || totalPages === 0 ? 'cursor-not-allowed opacity-50' : ''}">
                        <span class="sr-only">Siguiente</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                `;
                if (currentPage < totalPages - 1) {
                    nextButton.querySelector('button').addEventListener('click', () => {
                        currentPage++;
                        renderTable();
                        updatePagination();
                    });
                }
                paginationUl.appendChild(nextButton);

                tableNavigation.appendChild(paginationUl);
            }

            // Función para renderizar tabla
            function renderTable() {
                const start = currentPage * entriesPerPage;
                const end = start + entriesPerPage;
                const displayedRows = filteredRows.slice(start, end);

                // Limpiar tabla
                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }

                // Agregar filas filtradas
                displayedRows.forEach(row => {
                    tableBody.appendChild(row);
                });

                // Actualizar información de visualización
                showingStart.textContent = filteredRows.length > 0 ? start + 1 : 0;
                showingEnd.textContent = Math.min(end, filteredRows.length);
                totalEntries.textContent = filteredRows.length;
            }

            // Exportar a Excel
            document.getElementById('exportExcel').addEventListener('click', function() {
                const dataToExport = [];
                
                // Obtener encabezados
                const headers = [];
                table.querySelectorAll('thead th').forEach(th => {
                    const headerText = th.textContent.trim();
                    if (headerText !== 'Acciones') {
                        headers.push(headerText);
                    }
                });
                dataToExport.push(headers);
                
                // Obtener datos
                filteredRows.forEach(row => {
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
                XLSX.utils.book_append_sheet(wb, ws, 'Familias');
                
                // Guardar archivo
                XLSX.writeFile(wb, 'Familias_' + new Date().toISOString().slice(0, 10) + '.xlsx');
            });

            // Evento de cambio en la cantidad de entradas por página
            entriesPerPageSelect.addEventListener('change', function() {
                entriesPerPage = parseInt(this.value);
                currentPage = 0;
                renderTable();
                updatePagination();
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
                                text: 'La familia ha sido eliminada correctamente.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            document.querySelector(formId).submit();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cancelado',
                                text: 'La familia no ha sido eliminada.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });

            // Inicializar tabla
            sortTable('id_familia');
            updatePagination();
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