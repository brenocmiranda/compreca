<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    protected $table = 'imagens';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'tipo', 'caminho', 'created_at', 'updated_at'];

    public function RelationProdutos(){
    	return $this->hasMany(Imagens::class, 'produtos_imagens', 'id_imagem', 'id_produto');
    }
}
