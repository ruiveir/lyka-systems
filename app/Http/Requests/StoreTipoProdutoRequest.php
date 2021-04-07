<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'designacao'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'designacao.required' => 'É necessário inserir a designação do tipo de produto',
        ];
    }
    
    
}
