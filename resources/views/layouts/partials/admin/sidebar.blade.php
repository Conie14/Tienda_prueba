@php
    $links = [
        [
            'icon' => 'fas fa-chart-pie',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            //Familia de productos
            'icon' => 'fas fa-paw',
            'name' => 'Familias',          
            'route' => route('admin.familias.index'),
            'active' => request()->routeIs('admin.familias.*'),
        ],
        [
            //categorias de productos
            'icon' => 'fas fa-tags',
            'name' => 'Categorias',
            'route' => route('admin.categorias.index'),
            'active' => request()->routeIs('admin.categorias.*'),

        ]


    ];

@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}" 
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group bg-gray-100 dark:bg-gray-700 {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <span class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-500 transition duration-75 rounded-lg dark:text-gray-400 dark:bg-gray-700 group-hover:bg-gray-100 dark:group-hover:bg-gray-600 group-hover:text-gray-900 dark:group-hover:text-white">
                            <i class="{{$link['icon']}}"></i>

                        </span>

                        <span class="ms-3">{{$link['name']}}</span>
                    </a>
                </li>
            @endforeach



        </ul>
    </div>
</aside>
