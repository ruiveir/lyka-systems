<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibraryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'acesso' => 'required|in:Privado,Público',
            'descricao' => 'required',
            'ficheiro' => 'nullable',
            'file_name' => 'nullable',
            'tipo'=> 'nullable',
            'tamanho' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
           'file_name.required' => 'É necessária um nome para o ficheiro',
           'descricao.required' => 'É necessária uma descrição para o ficheiro',
       ];
    }
}
