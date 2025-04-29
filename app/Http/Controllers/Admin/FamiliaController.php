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
    public function index(Request $request)
    {
        $query = Familia::query();
        
        // Aplicar búsqueda si existe
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('id_familia', 'LIKE', "%{$search}%");
            });
        }
        
        // Aplicar ordenamiento
        if ($request->has('sort')) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            
            if (in_array($request->sort, ['id_familia', 'nombre'])) {
                $query->orderBy($request->sort, $direction);
            }
        } else {
            // Ordenamiento predeterminado
            $query->orderBy('id_familia', 'desc');
        }
        
        // Paginación
        $perPage = $request->has('per_page') ? (int)$request->per_page : 10;
        $familias = $query->paginate($perPage);
        
        // Mantener los parámetros de consulta en la URL
        $familias->appends($request->except('page'));
        
        //retornar la vista familia
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
        
        // Agregar el mensaje SweetAlert a la sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Familia creada correctamente',
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
        
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
        try {
            //eliminar solo el registro del id_familia
            $familia->delete();
            
            // Agregar el mensaje SweetAlert a la sesión
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Familia eliminada correctamente',
                'text' => '',
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);
            
            // redirigir a la vista de familias
            return redirect()->route('admin.familias.index')
                ->with('success', 'Familia eliminada correctamente');
        } catch (\Exception $e) {
            // Si ocurre un error, probablemente por relaciones con otras tablas
            return redirect()->route('admin.familias.index')
                ->with('error', 'No se puede eliminar la familia porque tiene categorías asociadas');
        }
    }
}