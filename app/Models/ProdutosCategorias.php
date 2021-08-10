<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosCategorias extends Model
{
    protected $table = 'produtos_categorias';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_categoria', 'id_produto', 'created_at', 'updated_at'];
}
