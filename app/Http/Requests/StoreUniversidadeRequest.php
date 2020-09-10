<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversidadeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'morada' => 'nullable|max:255',
            'telefone' => 'nullable',
            'email' => 'required|max:255|unique:universidade',
            'NIF' => 'required|unique:universidade',
            'IBAN' => 'nullable|unique:universidade',
            'observacoes' => 'nullable',
            'obsCursos' => 'nullable',
            'obsCandidaturas' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.unique'=> 'O email que colocou já está registado no sistema. Insira um email diferente.',
            'NIF.unique'=> 'O NIF que colocou já está registado no sistema. Insira um NIF diferente.',
            'IBAN.unique'=> 'O IBAN que colocou já está registado no sistema. Insira um IBAN diferente.'
        ];
    }
}
