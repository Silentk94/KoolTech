<?php

namespace App\Http\Requests\Frontend\Goods;

use Illuminate\Foundation\Http\FormRequest;

class SaveReturn extends FormRequest
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
            'SaveNo'=>'required',
        ];
       
    }
}
