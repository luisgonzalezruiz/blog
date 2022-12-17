<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

// esta libreria usamos para alzar los archivos
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    // cuando queremos sincronizar las propiedades de un objeto como (post) debemos definir las reglas de validacion
    protected $rules =[
        'post.name' => 'required',
        'post.slug' => 'required',
        'post.extract' => '',
        'post.body' => '',
        'post.img' =>'required'
    ];

    use WithFileUploads;


    public $open=false;
    public $name, $slug, $extract, $body, $img;

    public $identificador;   // es un axiliar para utilizar con la subida de imagen, para que se limpia el el input de tipo file

    //usuario actualmente autenticado
    public $user_id;
    public $status = 1;
    public $category_id = 1;
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save()
    {
        // de esta forma ejecuta la regla de validacion
        $this->validate();

        // antes de grabar o actualizar, vamos a ver si se eligio alguna imagen, de ser asi lo eliminamos
        if ($this->img) {
            Storage::delete([$this->post->img]);

            // volvemos a alzar la nueva imagen, y la url los actualizamos en la propiedad img del post
            $this->post->img = $this->img->store('posts_ext');
        }

        $this->post->save();

        // reseteamos los valores de las propiedades
        $this->reset(['open','name','slug','extract','body','status','category_id','img']);

        // de esta forma limpiamos
        $this->identificador = rand();

       // $this->emitTo('show-posts','pp');

        // este esta definido en el app.blade.php
        // es la forma de
        $this->emit('alert', 'Post actualizado correctamente!!!');
    }

}
