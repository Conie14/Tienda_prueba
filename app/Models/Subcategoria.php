<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_subcategoria';
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_categoria',
    ];

    //relacion uno a muchos inversa
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    //relacion uno a muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
    
}
