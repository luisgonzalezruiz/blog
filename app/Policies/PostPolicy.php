<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    // siempre que definamos una policy, el parametro obligatorio es user(para saber y evaluar el permiso al usuario que accede)
    public function author(User $user, Post $post)
    {
       // aqui verificamos si el usuario autenticado corresponde al usuario dueño del post que se intenta actualizar
      if( $user->id == $post->user_id ){
        return true;
      }else{
        //return false;
        return Response::deny('Accion no autorizada');
      }

    }

     // siempre que definamos una policy, el parametro obligatorio es user(para saber y evaluar el permiso al usuario que accede)

     // las politicas funcionan si o si con usuarios autenticados
     // para omitir que valide un usario autenticado, ponemos que el parametro usuario sea opcional ?
     public function published(?User $user, Post $post)
     {
        // verificamos para mostrar solo aquel post con status 2 o publicado
       if( $post->status == 2 ){
         return true;
       }else{
         return false;
       }

    }


}
