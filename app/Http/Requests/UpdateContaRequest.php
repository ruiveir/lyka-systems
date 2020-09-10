<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
          'morada' => 'nullable',
          'numConta' => ['required', Rule::unique('conta')->ignore($this->conta)],
          'IBAN' => ['required', Rule::unique('conta')->ignore($this->conta)],
          'SWIFT' => ['required', Rule::unique('conta')->ignore($this->conta)],
          'contacto' => 'required',
          'obsConta' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'numConta.unique' => 'O número de conta já está registado no sistema. Insira um número diferente.',
            'IBAN.unique' => 'O código IBAN já está registado no sistema. Insira um código diferente.',
            'SWIFT.unique' => 'O código SWIFT já está registado no sistema. Insira um código diferente.'
        ];
    }
}
