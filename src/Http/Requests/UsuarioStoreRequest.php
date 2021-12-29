<?php

namespace Brediweb\BrediDashboard8\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|string|min:4|max:255|confirmed',
            'roles'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'O campo senha é obrigatório',
            'password.string' => 'O campo senha deve ser uma string',
            'password.min' => 'O campo senha deve ter no mínimo 4 caracteres',
            'password.max' => 'O campo senha deve ter no máximo 255 caracteres',
            'password.confirmed' => 'O campo senha deve ser igual ao campo confirmação de senha',
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'Esse email já existe',
            'roles.required' => 'O campo permissão é obrigatório',
        ];
    }
}
