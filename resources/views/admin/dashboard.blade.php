<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],



]" >

    <div class="grid grid-cols-1 lg:grid-cols-2  md:grid-cols-2gap-6">
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex items-center justify-between mb-4">
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">Bienvenido,</h2>
                         {{auth()->user()->name}}
                    </h2>
                </div>
                
            </div>
        
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col items-center justify-center">
            <h2 class="text-lg font-semibold text-gray-800">
                Esta prueba
            </h2>
        
        </div>


    </div>

</x-admin-layout>
