<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Provedor;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $productos = Producto::orderBy('id_producto', 'desc')->paginate($perPage);
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los provedores para el formulario de creación
        $provedores = Provedor::all();
        // Obtener todas las subcategorias para el formulario de creación
        $subcategorias = Subcategoria::all();
        
        //retornar la vista de crear producto
        return view('admin.productos.create', compact('provedores', 'subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //recibir los datos del formulario
        $request->validate([
            'sku' => 'required|string|max:100|unique:productos,sku',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validar imagen
            'precio' => 'required|numeric|min:0',
            'id_provedor' => 'required|exists:provedors,id_provedor',  // Validar que id_provedor exista en la tabla provedores
            'id_subcategoria' => 'required|exists:subcategorias,id_subcategoria',  // Validar que id_subcategoria exista en la tabla subcategorias
        ]);
        
        //crear el producto
        Producto::create($request->all());
        
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creado correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        // Obtener todos los provedores para el formulario de edición
        $provedores = Provedor::all();
        // Obtener todas las subcategorias para el formulario de edición
        $subcategorias = Subcategoria::all();
        
        // Retornar la vista de editar producto y pasar el producto, los provedores y las subcategorias
        return view('admin.productos.edit', compact('producto', 'provedores', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validar los datos del formulario
        $request->validate([
            'sku' => 'required|string|max:100|unique:productos,sku,' . $producto->id_producto . ',id_producto',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validar imagen
            'precio' => 'required|numeric|min:0',
            'id_subcategoria' => 'required|exists:subcategorias,id_subcategoria',  // Validar que id_subcategoria exista en la tabla subcategorias
        ]);
    
        // Si el usuario subió una imagen
        if ($request->hasFile('imagen')) {
            // Almacenar la imagen y obtener su ruta
            $imagePath = $request->file('imagen')->store('productos', 'public');
            // Actualizar el producto con la nueva ruta de imagen
            $producto->imagen= $imagePath;
        }
    
        // Actualizar otros campos del producto
        $producto->sku = $request->input('sku');
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->id_subcategoria = $request->input('id_subcategoria');
    
        // Guardar el producto actualizado
        $producto->save();
    
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
    
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //eliminar el producto
        $producto->delete();
        
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Eliminado correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente');
    }
}