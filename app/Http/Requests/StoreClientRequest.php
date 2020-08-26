<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'paisNaturalidade' => 'nullable',
            'dataNasc' => 'nullable',
            'obsPessoais' => 'nullable',
            'obsAgente'=> 'nullable',
            'fotografia' => 'nullable',

            'num_docOficial'=> 'nullable|unique:Cliente',
            'validade_docOficial'=> 'nullable',
            'img_docOficial'=> 'nullable',
            'NIF' => 'nullable|unique:Cliente',

            'numPassaporte'=> 'nullable|unique:Cliente',
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
            'email' => 'nullable|unique:Cliente|unique:Agente|unique:User',
            'moradaResidencia' => 'nullable',
            'morada' => 'nullable',
            'cidade' => 'nullable',
            'nomePai' => 'nullable',
            'telefonePai'  => 'nullable',
            'emailPai' => 'nullable',
            'nomeMae' => 'nullable',
            'telefoneMae' => 'nullable',
            'emailMae' => 'nullable',

            'IBAN' => 'nullable|unique:Cliente|unique:Agente|unique:Conta',
            'obsFinanceiras' => 'nullable',

            'refCliente' => 'nullable',

            'estado' => 'required',
            'editavel' => 'required',
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
