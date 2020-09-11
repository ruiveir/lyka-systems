<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idAgente' => 'nullable',
            'nome' => 'required',
            'apelido' => 'required',
            'genero'=>'required',
            'paisNaturalidade' => 'required',
            'dataNasc' => 'nullable',
            'obsPessoais' => 'nullable',
            'obsAgente'=> 'nullable',
            'fotografia' => 'nullable',

            'num_docOficial'=> ['nullable', Rule::unique('cliente')->ignore($this->client)],
            'validade_docOficial'=> 'nullable',
            'img_docOficial'=> 'nullable',
            'NIF' => ['nullable', Rule::unique('cliente')->ignore($this->client)],

            'numPassaporte'=> ['nullable', Rule::unique('cliente')->ignore($this->client)],
            'dataValidPP'=> 'nullable',
            'passaportPaisEmi'=> 'nullable',
            'localEmissaoPP'=> 'nullable',
            'img_Passaporte'=> 'nullable',

            'nivEstudoAtual' => 'nullable',
            'nomeInstituicaoOrigem' => 'nullable',
            'cidadeInstituicaoOrigem' => 'nullable',
            'obsAcademicas' => 'nullable',

            'telefone1' => 'nullable',
            'telefone2' => 'nullable',
            'email' => ['nullable', Rule::unique('cliente')->ignore($this->client), Rule::unique('agente'), Rule::unique('administrador')],
            'moradaResidencia' => 'nullable',
            'morada' => 'nullable',
            'cidade' => 'nullable',
            'nomePai' => 'nullable',
            'telefonePai'  => 'nullable',
            'emailPai' => 'nullable',
            'nomeMae' => 'nullable',
            'telefoneMae' => 'nullable',
            'emailMae' => 'nullable',

            'IBAN' => ['nullable', Rule::unique('cliente')->ignore($this->client), Rule::unique('agente'), Rule::unique('conta')],
            'obsFinanceiras' => 'nullable',

            'refCliente' => 'nullable',

            'estado' => 'required',
            'editavel' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'O e-mail que colocou já está registado no sistema. Insira um e-mail diferente.',
            'num_docOficial.unique'=> 'O número de indentificação pessoal que colocou já está registado no sistema. Insira um num. de identificação diferente.',
            'numPassaporte.unique'=> 'O número de passaporte que colocou já está registado no sistema. Insira um num. de passaporte diferente.',
            'NIF.unique'=> 'O NIF que colocou já está registado no sistema. Insira um NIF diferente.',
            'IBAN.unique'=> 'O IBAN que colocou já está registado no sistema. Insira um IBAN diferente.'
        ];
    }
}
