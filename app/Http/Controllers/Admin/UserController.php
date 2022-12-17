<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // protegemos algunas rutas
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit','update');

    }

    public function index()
    {
        return view('admin.users.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit( User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }


    public function update(Request $request, User $user)
    {
        // de esta forma asignamos la tabla intermedia, los roles al usuario
        // $request->roles viene del formulario
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit',$user)->with('info','Roles asignados');
    }


    public function destroy($id)
    {
        //
    }
}
