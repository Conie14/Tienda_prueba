<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_opcion';
    protected $fillable = [
        'nombre',
        'tipo',
    ];

    // Relación muchos a muchos productos 
    public function productos()
    {
        return $this->belongsToMany(Producto::class)
            ->withPivot('valor')
            ->withTimestamps(); 
    }

    // Relación uno a muchos caracteristica con la clave foránea definida explícitamente
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class, 'id_opcion', 'id_opcion');
    }
}