<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_caracteristica';
    
    protected $fillable = [
        'valor',
        'descripcion',
        'id_opcion',
    ];

    // Definir correctamente la relación con Opcion
    public function opcion()
    {
        return $this->belongsTo(Opcion::class, 'id_opcion', 'id_opcion');
    }
    
    // Relación con la tabla pivote/variante si existe
    public function variantes()
    {
        return $this->belongsToMany(Variante::class, 'caracteristica_variante', 
                                    'id_caracteristica', 'id_variante');
    }
}