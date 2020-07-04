<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'morada' => 'required',
            'contacto' => 'required',
            'descricao' => 'required',
            'observacoes' => 'nullable'
        ];
    }
}
