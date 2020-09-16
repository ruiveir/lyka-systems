<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idUniversidade'=> 'nullable',
            'titulo' => 'required',
            'descricao' => 'nullable',
            'data_inicio' => 'required',
            'data_fim' => 'nullable',
            'cor' => 'required',
            'visibilidade' => 'required|in:0,1'
        ];
    }
}
