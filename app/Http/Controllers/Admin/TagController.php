<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{

    public function __construct()
    {
        // protegemos algunas rutas
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create','store');
        $this->middleware('can:admin.tags.edit')->only('edit','update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
        $colors =[
            'red' => 'Color rojo',
            'yellow' => 'Color amarillo',
            'green' => 'Color verde',
            'blue' => 'Color azul',
            'indigo' => 'Color indigo',
            'purple' => 'Color morado',
            'pink'=>'Color rosado'
        ];
        return view('admin.tags.create', compact('colors'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories',
            'color'=>'required'
        ]);

        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $tag = Tag::create($request->all());

        // vamos a redirigir a una ruta
        return redirect()->route('admin.tags.edit', $tag)->with('info','Etiqueta insertada!!!');;

    }


    /*
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }
    */


    public function edit(Tag $tag)
    {
        $colors =[
            'red' => 'Color rojo',
            'yellow' => 'Color amarillo',
            'green' => 'Color verde',
            'blue' => 'Color azul',
            'indigo' => 'Color indigo',
            'purple' => 'Color morado',
            'pink'=>'Color rosado'
        ];

        return view('admin.tags.edit', compact('tag','colors'));
    }


    public function update(Request $request, Tag $tag)
    {
        // de esta forma validamos los duplicados que no sea el registro que esta entrando
        // 'slug' => "required|unique:categories,slug,$category->id"

        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,$tag->id",
            'color'=> 'required'
        ]);


        // asi grabamos cuando la asignacion masiva esta activa, de lo contrario hacemos metodo tradicional(me gusta!)
        $tag->update($request->all());

        // vamos a redirigir a una ruta
        //return redirect()->route('admin.categories.index');

        // retornamos con un mensaje de en una variable de session
        return redirect()->route('admin.tags.edit', $tag)->with('info','Etiqueta actualizada!!!');

    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info','Etiqueta eliminada!!!');
    }
}
