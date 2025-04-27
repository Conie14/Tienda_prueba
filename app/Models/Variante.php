<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'sku',
        'imagen_path',
        'id_producto',
    ];

    //relacion uno a muchos inversa
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    //relacion uno a muchos caracteristica
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class)
            ->withTimestamps();
    }

}
