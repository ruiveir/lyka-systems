<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'morada' => 'nullable|max:255',
            'telefone' => 'nullable',
            'email' => 'required|max:255',
            'NIF' => 'required|unique:Universidade',
            'IBAN' => 'nullable',
            'observacoes' => 'nullable',
            'obsCursos' => 'nullable',
            'obsCandidaturas' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Nome da universidade é obrigatório ser preenchido.',
            'morada.required' => 'A Morada é obrigatória ser preenchida.',

            'email.required' => 'O Endereço Eletrónico é obrigatório ser preenchido.',
            'NIF.required' => 'O NIF é obrigatório ser preenchido.',
            'NIF.unique' => 'Este NIF já está em utilização.',
        ];
    }
}
