<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Familia extends Model
{
    //
    use HasFactory;

    
    protected $primaryKey = 'id_familia';

    protected $fillable = [
        'nombre',
        
    ];


    //relacion uno a muchos categorias
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }



}
