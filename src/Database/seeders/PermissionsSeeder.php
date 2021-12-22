<?php

namespace Database\Seeders;

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

        // Permissões para banner
        Permission::create(['name' => 'Alterar banner']);
        Permission::create(['name' => 'Excluir banner']);
        Permission::create(['name' => 'Visualizar banner']);
        Permission::create(['name' => 'Cadastrar banner']);

        // Permissões para notícia
        Permission::create(['name' => 'Alterar notícia']);
        Permission::create(['name' => 'Excluir notícia']);
        Permission::create(['name' => 'Visualizar notícia']);
        Permission::create(['name' => 'Cadastrar notícia']);

        // Permissões para menu
        Permission::create(['name' => 'Alterar menu']);
        Permission::create(['name' => 'Excluir menu']);
        Permission::create(['name' => 'Visualizar menu']);
        Permission::create(['name' => 'Cadastrar menu']);

        // Permissões para institucional
        Permission::create(['name' => 'Alterar institucional']);
        Permission::create(['name' => 'Excluir institucional']);
        Permission::create(['name' => 'Visualizar institucional']);
        Permission::create(['name' => 'Cadastrar institucional']);

        // Permissões para leis e normas
        Permission::create(['name' => 'Alterar leis e normas']);
        Permission::create(['name' => 'Excluir leis e normas']);
        Permission::create(['name' => 'Visualizar leis e normas']);
        Permission::create(['name' => 'Cadastrar leis e normas']);

        // Permissões para publicações
        Permission::create(['name' => 'Alterar publicações']);
        Permission::create(['name' => 'Excluir publicações']);
        Permission::create(['name' => 'Visualizar publicações']);
        Permission::create(['name' => 'Cadastrar publicações']);

        // Permissões para transparência
        Permission::create(['name' => 'Alterar transparência']);
        Permission::create(['name' => 'Excluir transparência']);
        Permission::create(['name' => 'Visualizar transparência']);
        Permission::create(['name' => 'Cadastrar transparência']);

        // Permissões para subseções
        Permission::create(['name' => 'Alterar subseções']);
        Permission::create(['name' => 'Excluir subseções']);
        Permission::create(['name' => 'Visualizar subseções']);
        Permission::create(['name' => 'Cadastrar subseções']);

        // Permissões para footer
        Permission::create(['name' => 'Alterar footer']);
        Permission::create(['name' => 'Excluir footer']);
        Permission::create(['name' => 'Visualizar footer']);
        Permission::create(['name' => 'Cadastrar footer']);

        // create roles and assign existing permissions
        Role::create(['name' => 'Administrador']);

        Role::create(['name' => 'Cliente']);
    }
}
