<?php

namespace Tests\Feature;

use App\Models\Provedor;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvedorTest extends TestCase
{
    use WithFaker;

    protected $user;

    /**
     * Configuración antes de cada prueba
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Ejecutar migraciones en la base de datos en memoria
        $this->artisan('migrate:fresh');
        
        // Crear un usuario autenticado para las pruebas
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
    }

    //listado de proveedores
    public function test_usuario_puede_ver_listado_de_proveedores(): void
    {
        // Crear algunos proveedores de prueba
        Provedor::factory()->count(3)->create();
        
        // hacer la solicitud
        $response = $this->actingAs($this->user)
                        ->get(route('admin.provedores.index'));
        
        // Verificar que la página carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('admin.provedores.index');
        $response->assertViewHas('provedors');
    }

    //crear un nuevo proveedor
    public function test_usuario_puede_crear_nuevo_proveedor(): void
    {
        $proveedorData = [
            'nombre' => 'Petco',
            'telefono' => '1234567890',
            'direccion' => 'Calle de Prueba 123',
            'email' => 'prueba@ejemplo.com',
        ];
        
        $countBefore = Provedor::count();
        
        $response = $this->actingAs($this->user)
                        ->post(route('admin.provedores.store'), $proveedorData);
        

        $response->assertRedirect(route('admin.provedores.index'));
        $response->assertSessionHas('success');
        

        $this->assertEquals($countBefore + 1, Provedor::count());
        
        // Verificar que los datos se guardaron correctamente
        $this->assertDatabaseHas('provedors', [
            'nombre' => 'Empresa de Prueba',
            'email' => 'prueba@ejemplo.com',
        ]);
    }

    //formulario para editar

    public function test_usuario_puede_ver_formulario_de_edicion(): void
    {
        $proveedor = Provedor::factory()->create();

        $response = $this->actingAs($this->user)
                        ->get(route('admin.provedores.edit', $proveedor->id_provedor));
        

        $response->assertStatus(200);
        $response->assertViewIs('admin.provedores.edit');
        $response->assertViewHas('provedor');
    }

    //actualizar un proveedor 
    public function test_usuario_puede_actualizar_proveedor(): void
    {
        // Crear un proveedor de prueba
        $proveedor = Provedor::factory()->create();
        
        // Datos actualizados para el proveedor
        $datosActualizados = [
            'nombre' => 'Coca Cola',
            'telefono' => '1234567890',
            'direccion' => 'Nueva Dirección 123',
            'correo' => 'nuevo@ejemplo.com',
        ];
        
        $response = $this->actingAs($this->user)
                        ->put(route('admin.provedores.update', $proveedor->id_provedor), $datosActualizados);
        
        $response->assertRedirect(route('admin.provedores.edit', $proveedor->id_provedor));

        $this->assertDatabaseHas('provedors', [
            'id_provedor' => $proveedor->id_provedor,
            'nombre' => 'Nombre Actualizado',
        ]);
    }

    //eliminar un proveedor

    public function test_usuario_puede_eliminar_proveedor(): void
    {
        $proveedor = Provedor::factory()->create();
        
        $response = $this->actingAs($this->user)
                        ->delete(route('admin.provedores.destroy', $proveedor->id_provedor));
        
        $response->assertRedirect(route('admin.provedores.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseMissing('provedors', [
            'id_provedor' => $proveedor->id_provedor,
        ]);
    }
}