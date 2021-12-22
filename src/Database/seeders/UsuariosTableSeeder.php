<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
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
		    'password' => Hash::make('bredi')
		))->assignRole($role1);
    }
}
