<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{


    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'category_id'
    ];

     // Un platillo pertenece a una categoría
     public function category()
     {
         return $this->belongsTo(Category::class, 'category_id');
     }
}
