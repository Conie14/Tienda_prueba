<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_categoria';
    protected $fillable = [
        'nombre',
        'id_familia',
    ];

    //relacion uno a muchos inversa
    public function familia()
    {
        return $this->belongsTo(Familia::class, 'id_familia');
    }

    //relacion uno a muchos subcategorias
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
    
}
