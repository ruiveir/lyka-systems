<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContaRequest extends FormRequest
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
          'numConta' => 'required',
          'IBAN' => 'required',
          'SWIFT' => 'required',
          'contacto' => 'nullable',
          'obsConta' => 'nullable'
        ];
    }
}
