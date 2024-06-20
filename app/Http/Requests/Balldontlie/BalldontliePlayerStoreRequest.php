<?php

namespace App\Http\Requests\Balldontlie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BalldontliePlayerStoreRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'height' => 'required',
            'weigth' => 'required',
            'jersey_number' => 'required',
            'college' => 'required',
            'country' => 'required',
            "draft_year" => 'required',
            "draft_round" => 'required',
            "draft_number" => 'required',
            'balldontlie_team_id' => 'required'

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
            'first_name.required' => 'O Campo First Name é obrigatório',
            'last_name.required' => 'O Campo Last Name é obrigatório',
            'position.required' => 'O Campo Position é obrigatório',
            'height.required' => 'O Campo Height é obrigatório',
            'weigth.required' => 'O Campo Weight é obrigatório',
            'jersey_number.required' => 'O Campo Number é obrigatório',
            'college.required' => 'O Campo College é obrigatório',
            'country.required' => 'O Campo Country é obrigatório',
            "draft_year.required" => 'O Campo Draft Year é obrigatório',
            "draft_round.required" => 'O Campo Draft Round é obrigatório',
            "draft_number.required" => 'O Campo Draft Number é obrigatório',
            'balldontlie_team_id.required' => 'O Campo Balldontlies Team é obrigatório'
        ];
    }
}
