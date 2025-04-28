<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subcategorias = Subcategoria::with('categoria')
        ->orderBy('id_subcategoria', 'desc')
        ->paginate(10);
        return view('admin.subcategorias.index', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Obtener todas las categorías para el formulario de creación
        $categorias = \App\Models\Categoria::all();
        //retornar la vista de crear subcategoria
        return view('admin.subcategorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //recibir los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'id_categoria' => 'required|exists:categorias,id_categoria',  // Validar que id_categoria exista en la tabla categorias
        ]);
        //crear la subcategoria
        Subcategoria::create($request->all());
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Creado correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoria creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategoria $subcategoria)
    {
        //obtener todas las categorías para el formulario de edición
        $categorias = \App\Models\Categoria::all();
        //retornar la vista de editar subcategoria
        return view('admin.subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        //validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'id_categoria' => 'required|exists:categorias,id_categoria',  // Validar que id_categoria exista en la tabla categorias
        ]);
        //actualizar la subcategoria
        $subcategoria->update($request->all());

        session()->flash('swal', [
            'title' => 'Categoría actualizado',
            'text' => 'La categoría se ha actualizado correctamente',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.subcategorias.edit', $subcategoria->id_subcategoria)->with('success', 'Subcategoria actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        //
        // Eliminar la subcategoría
        $subcategoria->delete();
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategoría eliminada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoria eliminada correctamente');
    }
}
