<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'status', 'mostrar_na_home', 'descricao', 'id_imagem', 'created_at', 'updated_at'];

    public function RelationImagens(){
        return $this->belongsTo(Imagens::class, 'id_imagem');
    }

    public function RelationSectionsCard(){
    	return $this->belongsTo(PagSectionsCard::class, 'id', 'id_marca');
    }
}
