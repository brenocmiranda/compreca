<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    protected $table = 'favoritos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_produto', 'id_cliente', 'created_at', 'updated_at'];

    public function RelationProdutos(){
        return $this->belongsTo(Produtos::class, 'id_produto', 'id');
    }
}
