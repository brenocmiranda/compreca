<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRqt extends FormRequest
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
                'documento' => 'required|string',
                'email' => 'required|email',
                'id_imagem' => 'nullable|image',
                'id_loja' => 'nullable|integer',
                'id_grupo' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'integer' => 'O campo :attribute só aceita valores númericos.',
        'email' => 'O campo :attribute aceita somente e-mails.',
        'string' => 'O campo :attribute só aceita de texto.',
        'image' => 'O campo :attribute só aceita imagens.',
        ];
    }
}
