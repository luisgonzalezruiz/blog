<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        // protegemos algunas rutas
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.create')->only('create','store');
        $this->middleware('can:admin.categories.edit')->only('edit','update');
        $this->middleware('can:admin.categories.destroy')->only('destroy');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories'
        ]);

        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $category = Category::create($request->all());

        // vamos a redirigir a una ruta
        return redirect()->route('admin.categories.edit', $category)->with('info','Categoria insertada!!!');;


        //aqui debemos redirigir al index
        //return $request->all();
    }


    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        // de esta forma validamos los duplicados que no sea el registro que esta entrando
        // 'slug' => "required|unique:categories,slug,$category->id"

        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:categories,slug,$category->id"
        ]);


        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $category->update($request->all());

        // vamos a redirigir a una ruta
        //return redirect()->route('admin.categories.index');

        // retornamos con un mensaje de en una variable de session
        return redirect()->route('admin.categories.edit', $category)->with('info','Categoria actualizada!!!');

        //aqui debemos redirigir al index
        //return $request->all();
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('info','Categoria eliminada!!!');

    }
}
