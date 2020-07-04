<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendRequest extends FormRequest
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

            'date_start' => 'required|date_format:Y-m-d|before_or_equal:date_end',
            'date_end' => 'required|date_format:Y-m-d|after_or_equal:date_start'

      ];


    }
}
