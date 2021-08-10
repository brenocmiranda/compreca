<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRqt extends FormRequest
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
                'variante' => 'required',
                'tipo' => 'required',
                'nome' => 'required|string',
                'id_marca' => 'required|integer',
                'categorias' => 'array',
                'variacoes' => 'array',
                'disponivel_venda' => 'nullable',
                'cod_sku' => 'required|string',
                'cod_ean' => 'nullable|integer',
                'quantidade' => 'required|integer',
                'preco_custo' => 'nullable|string',
                'preco_venda' => 'required|string',
                'preco_promocional' => 'nullable|string',
                'peso' => 'nullable|numeric',
                'largura' => 'nullable|numeric',
                'altura' => 'nullable|numeric',
                'comprimento' => 'nullable|numeric',
                'descricao' => 'nullable|string',
                'imagem_principal' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
        'required' => 'O campo :attribute é obrigatório',
        'min' => 'O campo :attribute deve possuir no minimo :min caracteres',
        'numeric' => 'O campo :attribute só aceita valores númericos.',
        'integer' => 'O campo :attribute só aceita valores inteiros.',
        'string' => 'O campo :attribute só aceita de texto.',
        'image' => 'O campo :attribute só aceita imagens.',
        ];
    }
}
