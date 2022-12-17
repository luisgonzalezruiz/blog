<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role1 = Role::create(['name'=>'Admin']);
       $role2 = Role::create(['name'=>'Blogger']);

        Permission::create(['name'=>'admin.home',
                            'description'=>'Ver dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Listado de usuarios'])->syncRoles([$role1, $role1]);
        Permission::create(['name'=>'admin.users.create',
                            'description'=>'Crear usuario'])->syncRoles([$role1, $role1]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'Editar usuario'])->syncRoles([$role1, $role1]);

        Permission::create(['name'=>'admin.categories.index',
                            'description'=>'Listado de categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.categories.create',
                            'description'=>'Crear categoria'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.edit',
                            'description'=>'Editar categoria'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.show',
                            'description'=>'Ver categoria'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.tags.index',
                            'description'=>'Listado de etiquetas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.tags.create',
                            'description'=>'Crear etiqueta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.edit',
                            'description'=>'Editar etiqueta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.show',
                            'description'=>'Ver etiqueta'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.posts.index',
                            'description'=>'Listado de posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.create',
                            'description'=>'Crear post'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.edit',
                            'description'=>'Editar post'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'admin.posts.show',
                            'description'=>'Mostrar post'])->syncRoles([$role1, $role2]);


    }
}
