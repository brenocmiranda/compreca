<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variacoes extends Model
{
    protected $table = 'variacoes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'status', 'id_opcao', 'id_loja', 'valor', 'created_at', 'updated_at'];

    public function RelationVariacoesProdutos(){
        return $this->belongsTo(ProdutosVariacoes::class, 'id', 'id_variacao');
    }
}
