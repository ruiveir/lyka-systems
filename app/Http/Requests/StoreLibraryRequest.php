<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'acesso'=>'required|in:Privado,Público',
            'descricao' => 'required',
            'ficheiro' => 'nullable',
            'link' => 'nullable',
            'file_name' => 'required',
            'tipo'=> 'required',
            'tamanho' => 'required'
        ];
    }
}
