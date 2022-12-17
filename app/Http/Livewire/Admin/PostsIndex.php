<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

use Livewire\WithPagination;


class PostsIndex extends Component
{
    use WithPagination;

    // por defecto livewire utiliza twilwind para estilizar los paginados
    // para indicarle que use bootstrap, se hace lo siguiente
    protected $paginationTheme = "bootstrap";

    // esta variable publica es la que se vera en la pantalla, seria databinding o model
    public $search;

    // este metodo se dispara automaticamente si el valor de la propiedad search cambia
    public function updatingSearch(){
        // reseteamos la url de la paginacion
        $this->resetPage();
    }


    // este metodo render es com oel index en un controlador tradicional.
    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
                ->where('name','LIKE', '%' . $this->search . '%')
                ->latest('id')
                ->paginate(10);

        return view('livewire.admin.posts-index', compact('posts'));
    }

}
