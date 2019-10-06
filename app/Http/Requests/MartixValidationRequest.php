<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatrixValidationRules;

class MartixValidationRequest extends FormRequest
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
            'mat1' =>  [ 'required', 'json', new MatrixValidationRules],
            'mat2' => [ 'required', 'json', new MatrixValidationRules],

        ];
    }

    public function messages()
    {
        return [
            'mat1.required' => 'Matrix is required',
            'mat1.json' => 'Matrix is not in proper json format',
            'mat2.required' => 'Matrix is required',
            'mat2.json' => 'Matrix is not in proper json format',
        ];
    }
}
