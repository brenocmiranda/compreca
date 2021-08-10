<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'status', 'variante', 'mostrar_na_home', 'tipo', 'nome', 'cod_sku', 'cod_ean', 'preco_custo', 'preco_venda', 'preco_promocional', 'peso', 'largura', 'altura', 'comprimento', 'quantidade', 'descricao', 'id_marca', 'id_loja', 'id_usuario', 'created_at', 'updated_at'];

    public function RelationImagens(){
    	return $this->belongsToMany(Imagens::class, 'produtos_imagens', 'id_produto', 'id_imagem')->where('tipo', '<>' ,'produtos_principal');
    }

    public function RelationImagensPrincipal(){
        return $this->belongsToMany(Imagens::class, 'produtos_imagens', 'id_produto', 'id_imagem')->where('tipo', 'produtos_principal');
    }

    public function RelationMarcas(){
        return $this->belongsTo(Marcas::class, 'id_marca');
    }

    public function RelationProdutosCategorias(){
    	return $this->belongsToMany(Categorias::class, 'produtos_categorias', 'id_produto', 'id_categoria');
    }

    public function RelationProdutosVariacoes(){
    	return $this->belongsToMany(Variacoes::class, 'produtos_variacoes', 'id_produto', 'id_variacao');
    }

    public function RelationSectionsCard(){
        return $this->belongsTo(PagSectionsCard::class, 'id', 'id_produto');
    }

    public function RelationLojas(){
        return $this->belongsTo(Lojas::class, 'id_loja');
    }

}
