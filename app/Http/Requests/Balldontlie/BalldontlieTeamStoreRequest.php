<?php

namespace App\Http\Requests\Balldontlie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BalldontlieTeamStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'conference' => 'required',
            'division' => 'required',
            'city' => 'required',
            'name' => 'required',
            'full_name' => 'required',
            'abbreviation' => 'required|unique:balldontlie_team,abbreviation'

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Errors found',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'conference.required' => 'O Campo Conference é obrigatório',
            'city.required' => 'O Campo City é obrigatório',
            'name.required' => 'O Campo Name é obrigatório',
            'full_name.required' => 'O Campo Full Name é obrigatório',
            'abbreviation.required' => 'O Campo Abbreviation é obrigatório',
            'abbreviation.unique' => 'O Valor do Campo Abbreviation deve ser unico'
        ];
    }
}
