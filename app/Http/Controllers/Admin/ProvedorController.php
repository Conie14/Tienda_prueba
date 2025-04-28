<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provedor;
use Illuminate\Http\Request;

class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $provedors = Provedor::
        orderBy('id_provedor', 'desc')
        ->paginate(10);

        //retornar la vista provedor
        return view('admin.provedores.index', compact('provedors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retornar la vista de crear provedor
        return view('admin.provedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // recibir los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'email' => 'required|string|max:100',
        ]);
        // crear el provedor
        Provedor::create($request->all());
        return redirect()->route('admin.provedores.index')->with('success', 'Provedor creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provedor $provedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provedor $provedor)
    {
        // retornar la vista de editar provedor
        return view('admin.provedores.edit', compact('provedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provedor $provedor)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'correo'   => 'required|email|max:100',
        ]);

        $provedor->update($request->all());

        session()->flash('swal', [
            'title' => 'Provedor actualizado',
            'text' => 'El provedor se ha actualizado correctamente',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.provedores.edit', $provedor->id_provedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provedor $provedor)
    {
        //eliminar el provedor
        $provedor->delete();
        
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria eliminada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);

        //redireccionar a la vista de provedors
        return redirect()->route('admin.provedores.index')->with('success', 'Provedor eliminado correctamente');
    }
}
