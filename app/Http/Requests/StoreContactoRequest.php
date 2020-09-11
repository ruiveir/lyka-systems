<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idUniversidade	'=> 'nullable',
            'fotografia'=> 'nullable',
            'nome' => 'required',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'email' => 'nullable',
            'fax' => 'nullable',
            'observacao' => 'nullable',
            'favorito' => 'required|in:1,0'
        ];
    }
}
