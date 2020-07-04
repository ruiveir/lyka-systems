<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChargeRequest extends FormRequest
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
            'comprovativoPagamento' => 'nullable|unique:DocTransacao',
            'observacoes' => 'nullable'
        ];
    }

    public function messages()
    {
      return[
        'valorRecebido.required' => 'O campo Valor Recebido necessita de ser preenchido.',
        'valorRecebido.regex' => 'O campo Valor Recebido deve ter o seguinte formato: 10,00 ou 10.000.',
        'dataOperacao.required' => 'O campo Data de Pagamento necessita de ser preenchido.',
        'dataRecebido.required' => 'O campo Data de Receção necessita de ser preenchido.',
        'comprovativoPagamento.unique' => 'Já existe um comprovativo de pagamento com a mesma denominação'
      ];
    }
}
