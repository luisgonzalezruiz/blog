<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public $categories, $title, $description, $post_id;
    public $isOpen = 0;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.admin.categories')
            ->extends('adminlte::page')
            ->section('content');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        $this->render();
    }

}
