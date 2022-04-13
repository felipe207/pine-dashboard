<?php

namespace Brediweb\BrediDashboard\Database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::find(1);
        User::create(array(
            'name' => 'Bredi',
            'email' => 'contato@bredi.com.br',
            'password' => Hash::make('bredi'),
        ))->assignRole($role1);
    }
}
