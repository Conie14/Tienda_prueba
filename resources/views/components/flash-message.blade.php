
@if (session()->has('mensaje'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show"
         class="fixed top-5 right-5 z-50 rounded-md p-4 {{ session('tipo') === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        <p>{{ session('mensaje') }}</p>
    </div>
@endif

<script>
    // Detectar mensajes flash desde Livewire
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('flash-message', event => {
            const message = event.detail.message;
            const type = event.detail.type || 'success';
            
            // Crear elemento de notificación
            const notification = document.createElement('div');
            notification.className = `fixed top-5 right-5 z-50 rounded-md p-4 ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            notification.innerHTML = `<p>${message}</p>`;
            
            // Agregar al DOM
            document.body.appendChild(notification);
            
            // Eliminar después de 3 segundos
            setTimeout(() => {
                notification.remove();
            }, 3000);
        });
    });
</script>