<?php

namespace Brediweb\BrediDashboard8\Database\seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(UsuariosTableSeeder::class);
    }
}
