<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRqt extends FormRequest
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
                'email' => 'required|string',
                'password' => 'nullable|string',
                'tipo' => 'required|string',
                'documento' => 'required|string',
                'nome' => 'required|string',
                'data_nascimento' => 'nullable|date',
                'apelido' => 'nullable|string',
                'sexo' => 'required|string',
                'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'min' => 'O campo :attribute deve possuir no minimo :min caracteres',
        'unique' => 'O contrato já foi adicionado!',
        'numeric' => 'O campo :attribute só aceita valores númericos.',
        'date' => 'A data não é válida.',
        ];
    }
}
