<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriasRqt extends FormRequest
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
                'status' => 'nullable',
                'nome' => 'required|string',
                'descricao' => 'nullable|string',
                'id_imagem' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'min' => 'O campo :attribute deve possuir no minimo :min caracteres',
        'string' => 'O :attribute deve ser preenchido com letras.!',
        ];
    }
}
