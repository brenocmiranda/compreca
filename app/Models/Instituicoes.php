<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicoes extends Model
{
    protected $table = 'instituicoes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'razao_social', 'status', 'mostrar_na_home', 'documento', 'descricao', 'cep', 'endereco', 'numero', 'complemeto', 'bairro', 'cidade', 'telefone', 'email', 'estado', 'id_logomarca', 'created_at', 'updated_at'];

    public function RelationLogomarca(){
        return $this->belongsTo(Imagens::class, 'id_logomarca');
    }

    public function RelationSectionsCard(){
    	return $this->belongsTo(PagSectionsCard::class, 'id', 'id_instituicoes');
    }
}
