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
            'refCliente' => 'required',
            'idAgente' => 'nullable',
            'idSubAgente' => 'nullable',
            'nome' => 'required',
            'apelido' => 'required',
            'genero'=> 'required',
            'paisNaturalidade' => 'required',
            'dataNasc' => 'nullable',
            'obsPessoais' => 'nullable',
            'obsAgente'=> 'nullable',
            'fotografia' => 'nullable',

            'num_docOficial'=> 'nullable|unique:cliente',
            'validade_docOficial'=> 'nullable',
            'img_docOficial'=> 'nullable',
            'NIF' => 'nullable|unique:cliente',

            'numPassaporte'=> 'nullable|unique:cliente',
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
            'email' => 'nullable|unique:cliente|unique:agente|unique:user',
            'moradaResidencia' => 'nullable',
            'morada' => 'nullable',
            'cidade' => 'nullable',
            'nomePai' => 'nullable',
            'telefonePai'  => 'nullable',
            'emailPai' => 'nullable',
            'nomeMae' => 'nullable',
            'telefoneMae' => 'nullable',
            'emailMae' => 'nullable',

            'IBAN' => 'nullable|unique:cliente|unique:agente|unique:conta',
            'obsFinanceiras' => 'nullable',

            'estado' => 'required',
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
