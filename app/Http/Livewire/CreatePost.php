<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


// esta libreria usamos para alzar los archivos
use Livewire\WithFileUploads;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreatePost extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;


    public $open=false;
    public $name, $slug, $extract, $body, $img;

    public $identificador;   // es un axiliar para utilizar con la subida de imagen, para que se limpia el el input de tipo file

    //usuario actualmente autenticado
    public $user_id;
    public $status = 1;
    public $category_id = 1;

    protected $rules =[
        'name'=>'required',
        'slug'=>'required',
        'extract'=>'required',
        'body'=>'required',
        'img'=>'required|image|max:2048'
    ];

    // definimos esta funcion de livewire que lo que hace es que cada vez que nosotros escribamos en la pantalla
    // el valide lo que esta definido en la regla, para ello debemos quitar la opcion "defer" del wire:clicl.defer
/*     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    protected $listeners = ['save'];


    public function mount()
    {
        // asi validamos si el usuario tiene o no acceso al formulario
        $this->authorize('dashboard');

        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->authorize('post.create.lw');

        // de esta forma ejecuta la regla de validacion
        $this->validate();

        $img = $this->img->store('posts_ext');

        $xx = Post::create([
            'name'=> $this->name,
            'slug'=> $this->slug,
            'extract'=>$this->extract,
            'body' =>$this->body,
            'user_id'=>Auth::user()->id,
            'status'=>$this->status,
            'img' => $img,
            'category_id'=>$this->category_id
        ]);

        // reseteamos los valores de las propiedades
        $this->reset(['open','name','slug','extract','body','status','category_id','img']);

        // de esta forma limpiamos
        $this->identificador = rand();


        // de esta forma, al crear el registro emitimos un evento
        // a quien le llamamos render, este evento debe ser escuchado en algun lugar
        // este lugar va ser el componente ShowPost
        //$this->emit('listar');

        // para lograr que solo escuche un componente especifico usamos el emitTo
        // especificamos que componente queremos que escuche y como segundo parametro usamos el nombre del evento
        // que esta definido en el listenner['listar'] del componente show-posts
        $this->emitTo('show-posts','listar');

        // este esta definido en el app.blade.php
        // es la forma de

        $this->emit('alerta', 'Post '. $xx->id .'insertado correctamente!!!');

        //$this->emitSelf('alerta', 'Post'. $xx->id .'insertado correctamente!!!');


    }

}
