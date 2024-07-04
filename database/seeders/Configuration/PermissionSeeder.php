<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'tasks.show-all']);
        Permission::create(['name' => 'tasks.create']);
        Permission::create(['name' => 'tasks.edit']);
        Permission::create(['name' => 'tasks.delete']);
    }
}
