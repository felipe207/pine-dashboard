<?php

namespace Brediweb\BrediDashboard8\Http\Controllers;

use Brediweb\BrediDashboard8\Http\Requests\UpdateUsuarioRequest;
use Brediweb\BrediDashboard8\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Brediweb\Imagemupload8\ImagemUpload;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        // $this->vendor = config('BrediDashboard.templates')[config('BrediDashboard.default')];

        $this->destino = storage_path() . '/app/public/user/';
        $this->resolucao = ['p' => ['h' => 150, 'w' => 150], 'm' => ['h' => 500, 'w' => 500]];

    }

    /**
     * Show the form for editing the specified resource.
     * Mostrar o formulário para editar o recurso especificado.
     * @return Response
     */
    public function edit()
    {
        $user = User::find(Auth::id());

        return view('controle.profile.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * Atualize o recurso especificado no armazenamento.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        try {

            $input = array_filter($request->all());

            if(isset($input['actual_password']) and !$this->oldPasswordValid($input)) {
                return redirect()->back()->withInput()->with('error', true)->with('msg', 'A senha atual é inválida!');
            }

            $imagens = ImagemUpload::salva([
                'input_file' => 'imagem',
                'destino' => 'user/',
                'resolucao' => ['m' => ['h' => 500, 'w' => 500], 'p' => ['h' => 150, 'w' => 150]],
                'preencher' =>['p'],
            ]);

            if ($imagens) {
                $input['imagem'] = $imagens;
            }

            if (isset($input['password']) and !empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            }

            $user = User::find(Auth::id())->update($input);

            return redirect()->back()->with('msg', 'Perfil atualizado com sucesso!');

        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('msg', 'Não foi possível alterar o perfil')->with('error', true)->with('exception', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * Remova o recurso especificado do armazenamento.
     * @return Response
     */
    public function destroy($user_id)
    {
        try {
            $user = User::find($user_id);

            $user->delete();

            return redirect()->back()->with('msg', 'Perfil excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível excluir o perfil.');
        }

    }

    public function oldPasswordValid($input)
    {
        $user = User::find(auth()->id());

        return Hash::check($input['actual_password'], $user->password);

    }
}
