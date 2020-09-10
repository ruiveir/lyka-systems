<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdministradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'apelido' => 'required',
            'genero' => 'required|in:F,M',
            'email' => 'required|unique:administrador|unique:user',
            'dataNasc' => 'required',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'superAdmin' => 'required'
        ];
    }

    public function messages()
    {
       return [
           'email.unique' => 'O e-mail que colocou já está registado no sistema. Insira um e-mail diferente.'
       ];
    }
}
