<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
]">
    <!-- Bienvenida y resumen general -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Control - Pet Shop</h2>
        <p class="text-gray-600">Bienvenido, {{ auth()->user()->name }}. Aquí tienes un resumen de tu tienda.</p>
    </div>

    <!-- Tarjetas de estadísticas principales -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Ventas totales -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-blue-600">
                <div class="flex justify-between items-center">
                    <h3 class="text-white font-semibold">Ventas del Mes</h3>
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
            </div>
            <div class="p-4">
                <p class="text-2xl font-bold text-gray-700">$12,349.99</p>
                <p class="text-sm text-green-600 flex items-center mt-1">
                    <i class="fas fa-arrow-up mr-1"></i> 15% vs mes anterior
                </p>
            </div>
        </div>

        <!-- Pedidos pendientes -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-yellow-500">
                <div class="flex justify-between items-center">
                    <h3 class="text-white font-semibold">Pedidos Pendientes</h3>
                    <i class="fas fa-shopping-cart text-white text-xl"></i>
                </div>
            </div>
            <div class="p-4">
                <p class="text-2xl font-bold text-gray-700">18</p>
                <p class="text-sm text-gray-600 flex items-center mt-1">
                    <i class="fas fa-clock mr-1"></i> Actualizado hace 15 min
                </p>
            </div>
        </div>

        <!-- Clientes nuevos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-green-600">
                <div class="flex justify-between items-center">
                    <h3 class="text-white font-semibold">Clientes Nuevos</h3>
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
            <div class="p-4">
                <p class="text-2xl font-bold text-gray-700">42</p>
                <p class="text-sm text-green-600 flex items-center mt-1">
                    <i class="fas fa-arrow-up mr-1"></i> 8% este mes
                </p>
            </div>
        </div>

        <!-- Inventario bajo -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-red-600">
                <div class="flex justify-between items-center">
                    <h3 class="text-white font-semibold">Productos en Alerta</h3>
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
            </div>
            <div class="p-4">
                <p class="text-2xl font-bold text-gray-700">7</p>
                <p class="text-sm text-red-600 flex items-center mt-1">
                    <i class="fas fa-exclamation-circle mr-1"></i> Stock bajo
                </p>
            </div>
        </div>
    </div>

    <!-- Gráficos y análisis -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Gráfico de ventas -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Ventas por Categoría</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-md">Mensual</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">Anual</button>
                </div>
            </div>
            <div class="h-64 flex items-center justify-center">
                <!-- Simulación de gráfico de pastel -->
                <div class="flex items-center justify-center w-full">
                    <div class="relative h-48 w-48 rounded-full" style="background: conic-gradient(#4F46E5 0% 25%, #16A34A 25% 50%, #EF4444 50% 65%, #F59E0B 65% 80%, #6B7280 80% 100%);">
                        <div class="absolute inset-0 flex items-center justify-center rounded-full bg-white h-24 w-24 m-auto"></div>
                    </div>
                    <div class="ml-6">
                        <div class="flex items-center mb-2">
                            <div class="h-3 w-3 bg-indigo-600 mr-2"></div>
                            <span class="text-sm">Alimentos (25%)</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="h-3 w-3 bg-green-600 mr-2"></div>
                            <span class="text-sm">Accesorios (25%)</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="h-3 w-3 bg-red-600 mr-2"></div>
                            <span class="text-sm">Medicinas (15%)</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="h-3 w-3 bg-yellow-500 mr-2"></div>
                            <span class="text-sm">Juguetes (15%)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="h-3 w-3 bg-gray-500 mr-2"></div>
                            <span class="text-sm">Otros (20%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de ventas mensuales -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Ventas Mensuales</h3>
                <select class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option>2025</option>
                    <option>2024</option>
                </select>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2 mt-4 px-2">
                <!-- Simulación de gráfico de barras -->
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-16 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$7,850</div>
                    <span class="text-xs mt-1 text-gray-600">Ene</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-24 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$9,420</div>
                    <span class="text-xs mt-1 text-gray-600">Feb</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-20 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$8,320</div>
                    <span class="text-xs mt-1 text-gray-600">Mar</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-28 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$10,250</div>
                    <span class="text-xs mt-1 text-gray-600">Abr</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-40 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$12,350</div>
                    <span class="text-xs mt-1 text-gray-600">May</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-36 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$11,980</div>
                    <span class="text-xs mt-1 text-gray-600">Jun</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-32 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$11,240</div>
                    <span class="text-xs mt-1 text-gray-600">Jul</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-36 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$11,890</div>
                    <span class="text-xs mt-1 text-gray-600">Ago</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-44 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$13,680</div>
                    <span class="text-xs mt-1 text-gray-600">Sep</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-40 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$12,750</div>
                    <span class="text-xs mt-1 text-gray-600">Oct</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-blue-500 rounded-t-sm h-44 hover:bg-blue-600 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$13,450</div>
                    <span class="text-xs mt-1 text-gray-600">Nov</span>
                </div>
                <div class="group relative">
                    <div class="w-5 bg-indigo-700 rounded-t-sm h-48 hover:bg-indigo-800 transition"></div>
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">$14,220</div>
                    <span class="text-xs mt-1 text-gray-600">Dic</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Secciones de información -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Productos más vendidos -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-4 bg-blue-100 border-b border-blue-200">
                <h3 class="text-lg font-semibold text-gray-800">Productos Más Vendidos</h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-200">
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-md p-2 mr-3">
                                <i class="fas fa-bone text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Royal Canin - 15kg</p>
                                <p class="text-sm text-gray-500">Alimento para perros</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">129 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-md p-2 mr-3">
                                <i class="fas fa-cat text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Arena para gatos Premium</p>
                                <p class="text-sm text-gray-500">10kg - Absorbente</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">98 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-md p-2 mr-3">
                                <i class="fas fa-paw text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Juguete interactivo</p>
                                <p class="text-sm text-gray-500">Para perros medianos</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">87 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-md p-2 mr-3">
                                <i class="fas fa-fish text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alimento para peces</p>
                                <p class="text-sm text-gray-500">Tropical - 200g</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">76 unidades</span>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver todos los productos →</a>
                </div>
            </div>
        </div>

        <!-- Últimos pedidos -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-4 bg-green-100 border-b border-green-200">
                <h3 class="text-lg font-semibold text-gray-800">Últimos Pedidos</h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-200">
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">#ORD-2458</p>
                            <p class="text-sm text-gray-500">Hace 25 minutos</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pendiente</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">#ORD-2457</p>
                            <p class="text-sm text-gray-500">Hace 1 hora</p>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">En proceso</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">#ORD-2456</p>
                            <p class="text-sm text-gray-500">Hace 2 horas</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Completado</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">#ORD-2455</p>
                            <p class="text-sm text-gray-500">Hace 3 horas</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Completado</span>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver todos los pedidos →</a>
                </div>
            </div>
        </div>

        <!-- Productos con stock bajo -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-4 bg-red-100 border-b border-red-200">
                <h3 class="text-lg font-semibold text-gray-800">Stock Bajo</h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-200">
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-md p-2 mr-3">
                                <i class="fas fa-exclamation-circle text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Collar antipulgas</p>
                                <p class="text-sm text-gray-500">Para perros grandes</p>
                            </div>
                        </div>
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">3 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-md p-2 mr-3">
                                <i class="fas fa-exclamation-circle text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Shampoo Medicado</p>
                                <p class="text-sm text-gray-500">Antiparasitario 500ml</p>
                            </div>
                        </div>
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">2 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-md p-2 mr-3">
                                <i class="fas fa-exclamation-circle text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Comedero automático</p>
                                <p class="text-sm text-gray-500">Dispensador digital</p>
                            </div>
                        </div>
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">4 unidades</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-md p-2 mr-3">
                                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cama ortopédica</p>
                                <p class="text-sm text-gray-500">Para perros senior</p>
                            </div>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">5 unidades</span>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Administrar inventario →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen por tipo de mascota -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-md p-4 border-t-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Productos para</p>
                    <p class="text-lg font-bold text-gray-800">Perros</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-dog text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-2xl font-bold text-gray-700">162</p>
                <p class="text-xs text-gray-500">42% del inventario</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-4 border-t-4 border-purple-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Productos para</p>
                    <p class="text-lg font-bold text-gray-800">Gatos</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-cat text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-2xl font-bold text-gray-700">128</p>
                <p class="text-xs text-gray-500">33% del inventario</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-4 border-t-4 border-yellow-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Productos para</p>
                    <p class="text-lg font-bold text-gray-800">Aves</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-feather-alt text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-2xl font-bold text-gray-700">48</p>
                <p class="text-xs text-gray-500">12% del inventario</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-4 border-t-4 border-green-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Productos para</p>
                    <p class="text-lg font-bold text-gray-800">Otros</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-fish text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-2xl font-bold text-gray-700">51</p>
                <p class="text-xs text-gray-500">13% del inventario</p>
            </div>
        </div>
    </div>

    <!-- Calendario y actividades -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recordatorios/Eventos -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Próximos Eventos</h3>
            <ul class="space-y-3">
                <li class="flex items-start">
                    <div class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center mr-3 shrink-0">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div>
                        <p class="font-medium">Recepción de inventario</p>
                        <p class="text-sm text-gray-500">Mañana, 10:00 AM</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <div class="bg-purple-100 text-purple-600 rounded-full w-10 h-10 flex items-center justify-center mr-3 shrink-0">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <p class="font-medium">Campaña de descuentos</p>
                        <p class="text-sm text-gray-500">Inicia en 3 días</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <div class="bg-green-100 text-green-600 rounded-full w-10 h-10 flex items-center justify-center mr-3 shrink-0">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div>
                        <p class="font-medium">Jornada de vacunación</p>
                        <p class="text-sm text-gray-500">Sábado, 9:00 AM - 2:00 PM</p>
                    </div>
                </li>
            </ul>
            <button class="mt-4 w-full py-2 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 transition flex items-center justify-center">
                <i class="fas fa-plus mr-2"></i> Agregar evento
            </button>
        </div>

        <!-- Actividad reciente -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Actividad Reciente</h3>
            <div class="relative">
                <!-- Línea de tiempo vertical -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <ul class="space-y-6 ml-6">
                    <li class="relative">
                        <div class="absolute -left-6 mt-1.5 h-3 w-3 rounded-full border-2 border-white bg-blue-600"></div>
                        <div>
                            <p class="font-medium text-gray-800">Nuevo pedido #ORD-2458</p>
                            <p class="text-sm text-gray-600">Cliente: María López</p>
                            <p class="text-xs text-gray-500 mt-1">Hace 25 minutos</p>
                        </div>
                    </li>
                    <li class="relative">
                        <div class="absolute -left-6 mt-1.5 h-3 w-3 rounded-full border-2 border-white bg-green-600"></div>
                        <div>
                            <p class="font-medium text-gray-800">Pedido completado #ORD-2456</p>
                            <p class="text-sm text-gray-600">Cliente: Juan García</p>
                            <p class="text-xs text-gray-500 mt-1">Hace 2 horas</p>
                        </div>
                    </li>
                    <li class="relative">
                        <div class="absolute -left-6 mt-1.5 h-3 w-3 rounded-full border-2 border-white bg-yellow-500"></div>
                        <div>
                            <p class="font-medium text-gray-800">Nuevo proveedor registrado</p>
                            <p class="text-sm text-gray-600">Alimentos Premium S.A.</p>
                            <p class="text-xs text-gray-500 mt-1">Hace 4 horas</p>
                        </div>
                    </li>
                    <li class="relative">
                        <div class="absolute -left-6 mt-1.5 h-3 w-3 rounded-full border-2 border-white bg-red-600"></div>
                        <div>
                            <p class="font-medium text-gray-800">Alerta de inventario</p>
                            <p class="text-sm text-gray-600">Collar antipulgas - Stock bajo</p>
                            <p class="text-xs text-gray-500 mt-1">Hace 5 horas</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver toda la actividad →</a>
            </div>
        </div>
    </div>
</x-admin-layout>