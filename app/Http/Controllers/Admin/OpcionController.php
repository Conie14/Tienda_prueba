<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opcion;

class OpcionController extends Controller
{
    //
    public function index()
    {
        $opciones = Opcion::
        orderBy('id_opcion', 'desc')
        ->paginate(10);
        return view('admin.opciones.index', compact('opciones'));
    }
}
