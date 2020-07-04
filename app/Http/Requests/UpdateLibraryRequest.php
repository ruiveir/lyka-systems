<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibraryRequest extends FormRequest
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
            'acesso'=>'required|in:Privado,Público',
            'descricao' => 'required',
            'file_name'=>'required',
            'ficheiro' => 'nullable',
            'tipo'=> 'required',
            'tamanho' => 'required',
        ];
    }

    public function messages()
    {
       return [
        'file_name.required'=>'É necessária um nome para o ficheiro',
        'descricao.required'=>'É necessária uma descrição para o ficheiro',
       ];
    }
}
