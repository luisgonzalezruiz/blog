<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // asignacion masiva, solo los que me gustaria insertar
    //protected $fillable = ['name','slug','color','extract','body','status','user_id','category_id'];

    // hacemos es por que solo estos campos no quiero grabar
    protected $guarded = ['id','created_at','updated_at'];

    // esto definimos de esta manera para que laravel use para mostrar en la URL el 'slug'
    // en lugar del codigo
    // esto es un accesor

    /*
    public function getRouteKeyName()
    {
        return 'slug';
    }
    */


    // relacion uno a muchos inverso
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
     }

     //relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //relacion uno a uno polimorfica
    // imageable es el metodo que definimos en el modelo images
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
        //return $this->hasMany(Image::class, 'imageable');
    }

}
