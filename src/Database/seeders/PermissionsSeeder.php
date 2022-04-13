<?php

namespace Brediweb\BrediDashboard\Database\seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissões para usuário
        Permission::create(['name' => 'Alterar usuário']);
        Permission::create(['name' => 'Excluir usuário']);
        Permission::create(['name' => 'Visualizar usuário']);
        Permission::create(['name' => 'Cadastrar usuário']);

        // create roles and assign existing permissions
        Role::create(['name' => 'Administrador']);
    }
}
