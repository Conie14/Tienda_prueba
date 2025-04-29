<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Familia;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Categoria::with('familia');
        
        // Aplicar búsqueda si existe
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('id_categoria', 'LIKE', "%{$search}%")
                  ->orWhereHas('familia', function($q) use ($search) {
                      $q->where('nombre', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Aplicar ordenamiento
        if ($request->has('sort')) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            
            if ($request->sort == 'id_categoria') {
                $query->orderBy('id_categoria', $direction);
            } elseif ($request->sort == 'nombre') {
                $query->orderBy('nombre', $direction);
            } elseif ($request->sort == 'familia') {
                // Ordenar por nombre de familia requiere un join
                $query->join('familias', 'categorias.id_familia', '=', 'familias.id_familia')
                      ->select('categorias.*')
                      ->orderBy('familias.nombre', $direction);
            }
        } else {
            // Ordenamiento predeterminado
            $query->orderBy('id_categoria', 'desc');
        }
        
        // Paginación
        $perPage = $request->has('per_page') ? (int)$request->per_page : 10;
        $categorias = $query->paginate($perPage);
        
        // Si hay un join en la consulta, es posible que necesitemos mantener los parámetros de consulta en la URL
        $categorias->appends($request->except('page'));
        
        return view('admin.categorias.index', compact('categorias'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las familias para el formulario de creación
        $familias = Familia::all();
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
        $familias = Familia::all();
        
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
            'title' => 'Categoria actualizado',
            'text' => 'La Categoria se ha actualizado correctamente',
            'icon' => 'success',
        ]);
        
        return redirect()->route('admin.categorias.edit', $categoria->id_categoria);
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