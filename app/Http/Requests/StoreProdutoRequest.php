<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            /*'descricao' => 'required|max:255',
            'tipoProduto' => 'required|in:Licenciatura,Mestrado,Doutoramento,Curso de Verão,Estágio Profissional,Transferência de Curso,Curso Indiomas,Erasmus,Pré-Universitário',
            'anoAcademico' => 'required|max:255',
            'valorTotal' => 'required',
            'valorTotalAgente' => 'required',
            '$idAgente' => 'required',
            '$idCliente' => 'required',
            '$idUniversidade1' => 'required',/**/
        ];
    }
}
