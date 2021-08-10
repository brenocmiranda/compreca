<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagSectionsCard extends Model
{
    protected $table = 'pag_sections_card';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'section', 'tagName', 'title_card', 'text_card', 'button_card', 'status', 'id_categoria', 'id_marca', 'id_produto', 'id_loja', 'id_instituicoes', 'id_imagem', 'created_at', 'updated_at'];

    public function RelationCategorias(){
    	return $this->belongsTo(Categorias::class, 'id_categoria');
    }

    public function RelationMarcas(){
    	return $this->belongsTo(Marcas::class, 'id_marca');
    }

    public function RelationProdutos(){
    	return $this->belongsTo(Produtos::class, 'id_produto');
    }

    public function RelationLojas(){
    	return $this->belongsTo(Lojas::class, 'id_loja');
    }

    public function RelationInstituicoes(){
    	return $this->belongsTo(Instituicoes::class, 'id_instituicoes');
    }

    public function RelationImagens(){
    	return $this->belongsTo(Imagens::class, 'id_imagem');
    }
}
