<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    //
    use HasFactory;

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



}
