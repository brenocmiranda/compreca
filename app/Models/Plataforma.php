<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    protected $table = 'plataforma';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'razao_social', 'cnpj', 'frase_descricao', 'descricao', 'cep', 'endereco', 'numero', 'complemeto', 'bairro', 'cidade', 'estado', 'telefone', 'whatsapp', 'email_contato', 'email_suporte', 'url_facebook', 'url_instagram', 'url_youtube', 'logomarca', 'icone', 'created_at', 'updated_at'];

    public function RelationLogomarca(){
        return $this->belongsTo(Imagens::class, 'logomarca');
    }

    public function RelationIcone(){
        return $this->belongsTo(Imagens::class, 'icone');
    }
}
