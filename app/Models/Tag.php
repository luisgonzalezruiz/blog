<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // asignacion masiva
    protected $fillable = ['name','slug','color'];

    // esto definimos de esta manera para que laravel use para mostrar en la URL el 'slug'
    // en lugar del codigo
    // esto es un accesor
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }

}
