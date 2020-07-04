<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descricao' => 'required',
            'instituicao' => 'required',
            'titular' => 'required',
            'morada' => 'required',
            'numConta' => 'required|unique:Conta',
            'IBAN' => 'required|unique:Conta',
            'SWIFT' => 'required|unique:Conta',
            'contacto' => 'nullable',
            'obsConta' => 'nullable'
        ];
    }
}
