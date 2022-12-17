<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

use App\Models\Category;
use App\Models\Tag;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function __construct()
    {
        // protegemos algunas rutas
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        //$posts = Post::all();
        // esto llama a la vista normal
        // esta vista utiliza un componente livewire para el renderizado,
        // la vista final que se ve es la de views/livewire/admin.... en este caso
        return view('admin.posts.index');
    }


    public function create()
    {

        // utilizamos el metodo pluck en lugar del metodo all() por que necesitamos pasarle al select el formato llave=>valor
        $categories = Category::pluck('name','id');

        $tags = Tag::all();

        return view('admin.posts.create', compact('categories','tags'));
    }


    public function store(PostRequest $request)
    {

        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $post = Post::create($request->all());

        // si viene alguna imagen seleccionada
        if($request->file('file')){
            // copiamos el archivo en la carpeta posts dentro del storage, y la url lo ponemos en la variable
            $url = Storage::put('posts', $request->file('file'));

            // una vez copiada la imagen al server, insertamos el registro en la db
            $post->image()->create([
                'url'=>$url
            ]);
        }

        //verificamos si la variable tags(array) tiene datos, si tiene almacenamos la tabla post_tag(gracias a la relacion tags que creamos en el modelo)
        //attach es el metodo adecuado para este efecto
        if($request->tags){
            //$post->tags()->attach($request->tags);
            $post->tags()->sync($request->tags);
        }

        // vamos a redirigir a una ruta
        return redirect()->route('admin.posts.edit', $post)->with('info','Post insertada!!!');;

    }


    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // invocamos al metodo authorize del controller y le pasamos como parametro el nombre del metodo
        // que definimos en la policy app/policies/PostPolicy
       $this->authorize('author', $post);

        // utilizamos el metodo pluck en lugar del metodo all() por que necesitamos pasarle al select el formato llave=>valor
        $categories = Category::pluck('name','id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post','categories','tags'));

    }


    public function update(Post $post, PostRequest $request)
    {
        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $post->update($request->all());

        if($request->file('file')){
            // copiamos el archivo en la carpeta posts dentro del storage, y la url lo ponemos en la variable
            $url = Storage::put('posts', $request->file('file'));

            if($post->image){
                // si hay registros, eliminamos la imagen
                Storage::delete($post->image->url);
                //actualizamos el registro con la url nueva
                $post->image->update([
                    'url'=>$url
                ]);
            }else{
                $post->image()->create([
                    'url'=>$url
                ]);
            }

            // una vez copiada la imagen al server, insertamos el registro en la db
            $post->image()->create([
                'url'=>$url
            ]);
        }

        // de esta forma insertamos en la tabla pivot
        $post->tags()->sync($request->tags);

        // retornamos con un mensaje de en una variable de session
        return redirect()->route('admin.posts.edit', $post)->with('info','Post actualizada!!!');

    }


    public function destroy(Post $post)
    {

        // debemos eliminar el archivo relacionado a este post
        // esto lo hacemos mediante los Observer de laravel App/Obervers se crea con php artisan make:observer PostObserver --model=Post
        //if($post->image){
        //    Storage::delete($post->image->url);
        //}

        // controlamos que solo se pueda eliminar un post del dueño

        $this->authorize('author', $post);

        $post->delete();
        return redirect()->route('admin.posts.index')->with('info','Post eliminada!!!');
    }
}
