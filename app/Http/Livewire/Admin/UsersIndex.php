<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // esta variable publica es la que se vera en la pantalla, seria databinding o model
    public $search;

    // este metodo se dispara automaticamente si el valor de la propiedad search cambia
    public function updatingSearch(){
        // reseteamos la url de la paginacion
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name','LIKE', '%' . $this->search . '%')
                    ->orWhere('name','LIKE', '%' . $this->search . '%')
                    ->latest('id')
                    ->paginate(6);

        // $users = User::paginate();
        return view('livewire.admin.users-index', compact('users'));
    }

}
