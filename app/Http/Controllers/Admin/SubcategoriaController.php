<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subcategoria::with('categoria');
        
        // Aplicar búsqueda si existe
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('id_subcategoria', 'LIKE', "%{$search}%")
                  ->orWhereHas('categoria', function($q) use ($search) {
                      $q->where('nombre', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Aplicar ordenamiento
        if ($request->has('sort')) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            
            if ($request->sort == 'id_subcategoria') {
                $query->orderBy('id_subcategoria', $direction);
            } elseif ($request->sort == 'nombre') {
                $query->orderBy('nombre', $direction);
            } elseif ($request->sort == 'descripcion') {
                $query->orderBy('descripcion', $direction);
            } elseif ($request->sort == 'categoria') {
                // Ordenar por nombre de categoría requiere un join
                $query->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id_categoria')
                      ->select('subcategorias.*')
                      ->orderBy('categorias.nombre', $direction);
            }
        } else {
            // Ordenamiento predeterminado
            $query->orderBy('id_subcategoria', 'desc');
        }
        
        // Paginación
        $perPage = $request->has('per_page') ? (int)$request->per_page : 10;
        $subcategorias = $query->paginate($perPage);
        
        // Si hay un join en la consulta, es posible que necesitemos mantener los parámetros de consulta en la URL
        $subcategorias->appends($request->except('page'));
        
        return view('admin.subcategorias.index', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Obtener todas las categorías para el formulario de creación
        $categorias = Categoria::all();
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
        $categorias = Categoria::all();
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
            'title' => 'Subcategoría actualizada',
            'text' => 'La subcategoría se ha actualizado correctamente',
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