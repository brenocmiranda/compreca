<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosImagens extends Model
{
    protected $table = 'produtos_imagens';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_imagem', 'id_produto', 'created_at', 'updated_at'];
}
