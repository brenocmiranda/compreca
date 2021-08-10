<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lojas extends Model
{
    protected $table = 'lojas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'razao_social', 'status', 'mostrar_na_home', 'documento', 'descricao', 'cep', 'endereco', 'numero', 'complemeto', 'bairro', 'cidade', 'telefone', 'email', 'estado', 'url_instagram', 'url_facebook', 'url_whatsapp', 'id_imagem', 'id_logomarca', 'id_instituicao', 'created_at', 'updated_at'];

    public function RelationImagens(){
        return $this->belongsTo(Imagens::class, 'id_imagem');
    }

    public function RelationLogomarca(){
        return $this->belongsTo(Imagens::class, 'id_logomarca');
    }

    public function RelationInstituicao(){
        return $this->belongsTo(Instituicoes::class, 'id_instituicao');
    }

    public function RelationSectionsCard(){
        return $this->belongsTo(PagSectionsCard::class, 'id', 'id_loja');
    }    

    public function RelationProdutos(){
        return $this->hasMany(Produtos::class, 'id_loja', 'id');
    }

    public function RelationMarcas(){
        return $this->hasMany(Marcas::class, 'id_loja', 'id');
    }

    public function RelationCategorias(){
        return $this->hasMany(Categorias::class, 'id_loja', 'id');
    }
}
