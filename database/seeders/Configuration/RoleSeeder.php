<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create([
            'name' => 'superadmin',
            'display_name' => 'Super Administrador',
            'description' => 'Administrador Supremo del Sistema'
        ])->givePermissionTo(Permission::all()->pluck('name'));

        Role::create([
            'name' => 'user',
            'display_name' => 'Usuario',
            'description' => 'Usuario'
        ])->givePermissionTo(['tasks.create', 'tasks.edit', 'tasks.delete']);
    }
}
