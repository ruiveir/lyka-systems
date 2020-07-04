<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactoRequest extends FormRequest
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
            'idUniversidade	'=> 'nullable',
            'fotografia'=> 'nullable',
            'nome' => 'required',
            'telefone1' => 'nullable',
            'telefone2' => 'nullable',
            'email' => 'nullable',
            'fax' => 'nullable',
            'observacao' => 'nullable',
            'favorito' => 'required|in:1,0',

        ];
    }
}
