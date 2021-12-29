<?php

namespace Brediweb\BrediDashboard8\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Brediweb\BrediDashboard8\Http\Requests\UsuarioStoreRequest;
use Brediweb\BrediDashboard8\Http\Requests\UsuarioUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('controle.usuario.index', compact('usuarios'));
    }

    public function create(User $usuario = null)
    {
        $data = ['roles'];

    	$roles = Role::pluck('name','name')->all();

        return view('controle.usuario.form', compact($data));
    }

    public function store(UsuarioStoreRequest $request)
    {
        try {
            //code...
            $user = User::create([
                'name' => $request->input('name'),
                'grupo_usuario_id' => $request->input('grupo_usuario_id'),
                'email'  => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            $user->assignRole($request->input('roles'));

            return redirect()->route('controle.usuario.index')->with('msg', 'Usuário cadastrado com sucesso.')->with('error', false);

        } catch (\Throwable $th) {
            return redirect()->route('controle.usuario.create')->with('msg', 'Não foi possível efetuar a operação.')->with('error', true);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->id != Auth::user()->id) {
            $user->delete();
            return redirect()->route('controle.usuario.index')->with('msg', 'Operação realizada com sucesso')->with('error', false);
        }else
        {
            return redirect()->route('controle.usuario.index')->with('msg', 'Não foi possível efetuar a operação')->with('error', true);
        }

    }

    public function edit($id)
    {
        $data = ['roles','user'];

    	$roles = Role::pluck('name','name')->all();
        $user = User::find($id);

        return view('controle.usuario.form', compact($data));
    }

    public function update($id, UsuarioUpdateRequest $request)
    {

        try {
            if ($request->only('password')['password'] == null) {
                $input = $request->except('password','password_confirmation');
            }else{
                $input = $request->all();

                $input['password'] = Hash::make($request->input('password'));
            }


            $user = User::findOrFail($id);

            $user->update($input);

            $user->syncRoles($request->input('roles'));

            return redirect()
                    ->route('controle.usuario.index')
                    ->with('msg', 'Operação realizada com sucesso.')
                    ->with('error', false);

        } catch (\Throwable $th) {
            dd($th);
            return redirect()
                    ->route('controle.usuario.index')
                    ->with('msg', 'Falha na operação.')
                    ->with('error', true);
        }
    }
}
