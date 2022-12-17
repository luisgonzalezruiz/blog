<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    public function creating(Post $post)
    {
        // antes de insertar le pasamos el usuario actualmente autenticado.
        // esto mismo podemos hacer en el controlador tambien, pero para probar un observer funciona bien.

        // verificamos primero por donde se ejecuta el insert
        // si estamos haciendo mediante migracion, esto no se va ejecutar, si hacemos por pantalla si
        if(! \App::runningInConsole()){
            $post->user_id = auth()->user()->id;
        }


    }


    public function updated(Post $post)
    {
        //
    }


    public function deleting(Post $post)
    {
        if($post->image){
            Storage::delete($post->image->url);
        }
    }


    public function restored(Post $post)
    {
        //
    }


    public function forceDeleted(Post $post)
    {
        //
    }
}
