<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgenteRequest extends FormRequest
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
            'idAgenteAssociado'=> 'nullable',
            'exepcao' => 'required',
            'nome' => 'required',
            'apelido' => 'required',
            'genero'=>'required',
            'tipo' => 'required|in:Agente,Subagente',
            'email' => 'required',
            'dataNasc' => 'required',
            'fotografia' => 'nullable',
            'morada' => 'required',
            'pais' => 'required',
            'NIF' => 'required',
            'num_doc'=> 'required',
            'img_doc' => 'nullable',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'IBAN' => 'nullable',
            'observacoes'=> 'nullable',
        ];
    }

        public function messages()
    {
       return [
        'email.unique'=>'Este e-mail já está registado. Insira um e-mail diferente',
        'NIF.unique'=>'Este NIF já está registado. Insira um NIF diferente',
        'num_doc.unique'=>'Esta identificação já esta registada.',
       ];
    }
}



