<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_caracteristica';

    protected $fillable = [
        'nombre',
        'valor',
        'descripcion',
        'id_opcion'
    ];

    //relacion uno a muchos variantes
    public function variante()
    {
        return $this->belongsTo(Variante::class)
            ->withTimestamps();
    }

    //relacion uno a muchos opciones
    public function opcion()
    {
        return $this->belongsTo(Opcion::class, 'id_opcion', 'id_opcion');
    }



}
