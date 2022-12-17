<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;

// esta libreria usamos para alzar los archivos
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

class ShowPosts extends Component
{
    use WithPagination;

    use WithFileUploads;


    // tener en cuenta que esta variable debe ser unica tanto aqui en el componente como la vista
    public $post;

    public $name, $slug, $extract, $body, $img;

    public $identificador;   // es un axiliar para utilizar con la subida de imagen, para que se limpia el el input de tipo file

    //usuario actualmente autenticado
    public $user_id;
    public $status = 1;
    public $category_id = 1;

    // toda variable publica definida en el componente sera accesible desde la vista en cuestion
    public $nombre;
    public $search;

    public $sort = 'id';
    public $direction = 'desc';

    public $open_edit = false;

    public $productos=[];
    public $producto;

    // cuando queremos sincronizar las propiedades de un objeto como (post) debemos definir las reglas de validacion
    protected $rules = [
        'post.name' => 'required',
        'post.slug' => 'required',
        'post.extract' => '',
        'post.body' => '',
        'post.img' => 'required'
    ];


    // definimos una propiedad de tipo protected, para que sea el que se encargue de escuchar
    // el evento que emitimos al crear el registro
    // el nombre del evento es el mismo que definimos al crear el registro
    // notar que en el array definimos 'listar' y le asignamos el metodo a ser ejecutado
    protected $listeners = ['pp' => 'render'];


    // este metodo se dispara automaticamente si el valor de la propiedad search cambia
    public function updatingSearch()
    {
        // reseteamos la url de la paginacion
        $this->resetPage();
    }

    // si queremos recibir los valores en otra propiedad, definimos el metodo mount() como un constructor
    // como parametro ponemos lo que viene desde la llamanda

    public function mount()
    {
        $this->identificador = rand();
        // vamos a instanciar la variable $post como tipo Post
        $this->post = new Post();
    }

    public function render()
    {
        $posts = Post::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('body', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        //$posts = Post::latest('id')->paginate(10);
        //$posts = Post::all();
        // de esta forma el livewire usa y extiende de la plantilla app.blade.php

        //$this->emit('alerta', $posts);

        return view('livewire.show-posts', compact('posts'));

        // si queremos extender de otra plantilla, lo usamos asi
        //return view('livewire.show-posts')->layout('layouts.base');
    }

    // esto es un metodo de prueba para verificar la ruta
    //public function listar($name)
    //{
    //    return $name;
    //}

    public function order($campo)
    {
        if ($this->sort == $campo) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $campo;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post)
    {
        $this->post = $post;

        //abrimos el modal cambiando la propiedad
        $this->open_edit = true;
    }

    public function update()
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
        $this->reset(['open_edit', 'name', 'slug', 'extract', 'body', 'status', 'category_id', 'img']);

        // de esta forma limpiamos
        $this->identificador = rand();

        //$this->emitTo('show-posts','listar');

        // este esta definido en el app.blade.php
        // es la forma de emitir un alert
        $this->emit('alert', 'El Post '. $this->post->id .' actualizado correctamente!!!');

    }

    public function agregar()
    {
         $this->item = [
                    "id" => $this->producto,
                    "nombre" => "test".$this->producto
                ];

             /*    $data = [
                     ['name' => 'Name', 'completed' => 0],
                     ['name' => 'Name 2', 'completed' => 1],
                 ];
 */
        $this->productos[]  = collect($this->item);

        $this->emit('alerta', $this->productos);

    }

    public function eliminar(Post $post){
        $post->delete();

    }


}
