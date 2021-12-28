<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('imagem')->nullable();
        });

        $role1 = Role::find(1);
        User::create(array(
		    'name' => 'Bredi',
		    'email' => 'contato@bredi.com.br',
		    'password' => Hash::make('bredi')
		))->assignRole($role1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });
    }
}
