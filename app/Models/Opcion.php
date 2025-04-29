<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_opcion';

    protected $fillable = [
        'nombre',
        'tipo',
    ];

    //relacion muchos a muchos productos 
    public function productos()
    {
        return $this->belongsToMany(Producto::class)
            ->withPivot('valor')
            ->withTimestamps(); 
    }

    //relacion uno a muchos caracteristica
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class, 'id_opcion', 'id_opcion');
    }

    


}
