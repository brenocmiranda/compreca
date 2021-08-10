<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use Notifiable;
    
   	protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'status', 'documento', 'email', 'email_verified_at', 'password', 'id_loja', 'id_grupo', 'id_imagem', '_token', 'remember_token', 'created_at', 'updated_at'];

    public function RelationAtividades(){
        return $this->belongsTo(Atividades::class, 'id', 'id_usuario')->orderBy('created_at', 'DESC');
    }

    public function RelationImagens(){
        return $this->belongsTo(Imagens::class, 'id_imagem');
    }

    public function RelationLojas(){
        return $this->belongsTo(Lojas::class, 'id_loja', 'id');
    }

    public function RelationGrupo(){
        return $this->belongsTo(GruposUsuarios::class, 'id_grupo');
    }
}
