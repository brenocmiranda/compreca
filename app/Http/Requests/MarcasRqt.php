<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcasRqt extends FormRequest
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
                'ativo' => 'nullable',
                'nome' => 'required|string',
                'mostrar_na_home' => 'nullable',
                'descricao' => 'nullable|string',
                'id_imagem' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'string' => 'O campo :attribute só aceita de texto.',
        'image' => 'O campo :attribute só aceita imagens.',
        ];
    }
}
