<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Familia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familias = Familia::
        orderBy('id_familia', 'desc')
        ->paginate(10); 
        return view('admin.familias.index', compact('familias'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retornar la vista de crear familia
        return view('admin.familias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // recibir los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            
        ]);
        // crear la familia
        Familia::create($request->all());
        return redirect()->route('admin.familias.index')->with('success', 'Familia creada correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Familia $familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Familia $familia)
    {
        //retornar la vista de editar familia
        return view('admin.familias.edit', compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Familia $familia)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);
        
        // Actualizar la familia
        $familia->update($request->all());
        
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Familia actualizada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        
        // Redirigir a la vista de edición con el mensaje SweetAlert
        return redirect()->route('admin.familias.edit', $familia->id_familia);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Familia $familia)
    {
        //eliminar solo el registro del id_familia
        $familia->delete();
        // redirigir a la vista de familias
        return redirect()->route('admin.familias.index')->with('success', 'Familia eliminada correctamente')
        ->with('error', 'No se puede eliminar la familia porque tiene categorias asociadas');

        

    }
}
