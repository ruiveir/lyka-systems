<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
          'email' => 'required|unique:User',
          'password' => 'nullable',
        ];
    }

    public function messages()
    {
       return [
       'email.required' => 'O e-mail deve ser preenchido corretamente.',
       'email.unique' => 'Este e-mail ja se encontra registado.',
       ];
    }
}
