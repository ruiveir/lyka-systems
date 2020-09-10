<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idAgenteAssociado'=> 'nullable',
            'exepcao' => 'required',
            'nome' => 'required',
            'apelido' => 'required',
            'genero'=>'required',
            'tipo' => 'required|in:Agente,Subagente',
            'email' => 'required|unique:agente|unique:cliente|unique:administrador|unique:user',
            'dataNasc' => 'required',
            'fotografia' => 'nullable',
            'morada' => 'required',
            'pais' => 'required',
            'NIF' => 'required|unique:agente',
            'num_doc'=> 'required|unique:agente',
            'img_doc' => 'nullable',
            'telefone1' => 'required',
            'telefone2' => 'nullable',
            'IBAN' => 'nullable|unique:agente',
            'observacoes'=> 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'O e-mail que colocou já está registado no sistema. Insira um e-mail diferente.',
            'NIF.unique' => 'O NIF que colocou já está registado no sistema. Insira um NIF diferente.',
            'IBAN.unique' => 'O IBAN que colocou já está registado no sistema. Insira um IBAN diferente.',
            'num_doc.unique' => 'O número de indentificação pessoal que colocou já está registado no sistema. Insira um num. de identificação diferente.'
        ];
    }
}
