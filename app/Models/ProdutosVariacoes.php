<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosVariacoes extends Model
{
    protected $table = 'produtos_variacoes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_variacao', 'id_produto', 'created_at', 'updated_at'];
}
