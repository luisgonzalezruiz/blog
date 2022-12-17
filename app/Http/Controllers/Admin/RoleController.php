<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        //* $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info','Rol creado con exito!!!');;
    }


    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.show', compact('role','permissions'));
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'name' => "required|unique:roles,name,$role->id"
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info','Rol actualizado con exito!!!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('info','Rol eliminado con exito!!!');
    }
}
