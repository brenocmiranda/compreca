<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicoesRqt extends FormRequest
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
                'razao_social' => 'required|string',
                'documento' => 'required|string',
                'descricao' => 'nullable|string',
                'cep' => 'required|string',
                'endereco' => 'required|string',
                'numero' => 'required|integer',
                'complemento' => 'nullable|string',
                'bairro' => 'nullable|string',
                'cidade' => 'nullable|string',
                'estado' => 'nullable|string',
                'bairro1' => 'nullable|string',
                'cidade1' => 'nullable|string',
                'estado1' => 'nullable|string',
                'telefone' => 'required|string',
                'email' => 'required|string',
                'id_logomarca' => 'required|image',                       
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'min' => 'O campo :attribute deve possuir no minimo :min caracteres',
        'number' => 'O campo :attribute só aceita valores númericos.',
        'date' => 'A data não é válida.',
        'image' => 'O :attribute só aceita imagens.',
        ];
    }
}
