<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar las categorías con la relación 'familia' para evitar consultas adicionales
        $categorias = Categoria::with('familia')->orderBy('id_categoria', 'desc')->paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las familias para el formulario de creación
        $familias = \App\Models\Familia::all();
        //retornar la vista de crear categoria
        return view('admin.categorias.create', compact('familias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //recibir los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'id_familia' => 'required|exists:familias,id_familia',  // Validar que id_familia exista en la tabla familias
        ]);
        
        //crear la categoria
        Categoria::create($request->all());
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creado correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        // Obtener todas las familias para el formulario de edición
        $familias = \App\Models\Familia::all();
        
        //retornar la vista de editar categoria
        return view('admin.categorias.edit', compact('categoria', 'familias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        
        //Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'id_familia' => 'required|exists:familias,id_familia',
        ]);
        
        //Actualizar la categoria
        $categoria->update($request->all());
        
        // Corregir el mensaje de SweetAlert para reflejar que se actualiza una categoría, no una familia
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoría actualizada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        
        return redirect()->route('admin.categorias.index', $categoria->id_categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //eliminar solo el registro del id_familia
        $categoria->delete();
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria eliminada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        // redirigir a la vista de categorias
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria eliminada correctamente');
    }
}
