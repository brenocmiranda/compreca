<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosProdutos extends Model
{
    protected $table = 'pedidos_produtos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'status', 'quantidade', 'valor_unitario', 'valor_total', 'id_pedido', 'id_produto', 'id_cliente', 'created_at', 'updated_at'];

    public function RelationProdutos(){
        return $this->belongsTo(Produtos::class, 'id_produto');
    }
}
