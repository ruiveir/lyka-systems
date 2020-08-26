<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            /*'tipo' => 'required',
            'descricao' => 'required',
            'anoAcademico'=>'required',
            'idAgente' => 'required',
            'idUniversidade1' => 'required',*/
        ];
    }
}
