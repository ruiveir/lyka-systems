<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChargeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'valorRecebido' => ['required', 'regex:/^((\d+)|(\d{1,3}(\.\d{3})+)|(\d{1,3}(\.\d{3})(\,\d{3})+))(\,\d{2})?$/'],
            'tipoPagamento' => 'required',
            'dataOperacao' => 'required',
            'dataRecebido' => 'required',
            'comprovativoPagamento' => 'nullable|unique:doc_transacao',
            'observacoes' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'valorRecebido.regex' => 'O formato do Valor recebido está incorreto. Utilize um formato correto, sendo que para separar decimais, utilize uma vírgula.'
        ];
    }
}
