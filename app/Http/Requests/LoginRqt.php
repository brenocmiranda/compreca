<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRqt extends FormRequest
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
                'email' => 'required|min:6',
                'password' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'min' => 'O campo :attribute deve possuir no minimo :min caracteres',
        'numeric' => 'O campo :attribute só aceita valores númericos.',
        'date' => 'A data não é válida.',
        ];
    }
}
