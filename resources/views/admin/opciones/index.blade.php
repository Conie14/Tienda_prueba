<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
    ],

]">

    @livewire('admin.opciones.administrar-opciones')



</x-admin-layout>