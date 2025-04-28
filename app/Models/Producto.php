<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'sku',
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'id_subcategoria',
        'id_provedor',
    ];
    
    //relacion uno a muchos inversa provedor
    public function provedor()
    {
        return $this->belongsTo(Provedor::class, 'id_provedor');
    }

    //relacion uno a muchos inversa
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria');
    }



    //relacion uno a muchos inversa variantes
    public function variantes()
    {
        return $this->hasMany(Variante::class);
    }

    //relacion muchos a muchos opciones
    public function opciones()
    {
        return $this->belongsToMany(Opcion::class)
            ->withPivot('valor')
            ->withTimestamps(); 
    }

}
