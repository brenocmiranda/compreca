<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'status', 'descricao', 'id_imagem', 'created_at', 'updated_at'];

    public function RelationImagens(){
        return $this->belongsTo(Imagens::class, 'id_imagem');
    }

    public function RelationCategoriasProdutos(){
        return $this->belongsTo(ProdutosCategorias::class, 'id', 'id_categoria');
    }

    public function RelationSectionsCard(){
    	return $this->belongsTo(PagSectionsCard::class, 'id', 'id_categoria');
    }
}
