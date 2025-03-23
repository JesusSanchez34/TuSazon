<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre'];
    
    // Una categoría tiene muchos platillos
    public function platillos()
{
    return $this->hasMany(Platillo::class);
}
}
