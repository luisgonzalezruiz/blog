<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // asignacion masiva
    protected $fillable = ['name','slug'];

    // esto definimos de esta manera para que laravel use para mostrar en la URL el 'slug'
    // en lugar del codigo
    // esto es un accesor
    public function getRouteKeyName()
    {
        return 'slug';
    }


    // una categoria tiene muchos posts
    public function posts(){
        return $this->hasMany(Post::class);
    }

}
