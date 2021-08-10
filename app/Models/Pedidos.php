<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'num_pedido', 'id_transacao', 'valor_produtos', 'valor_frete', 'valor_juros', 'valor_desconto', 'valor_total', 'id_nota', 'id_rastreio', 'id_forma_pagamento', 'id_forma_envio', 'id_cliente', 'id_endereco', 'created_at', 'updated_at'];

    public function RelationFormasPagamento(){
        return $this->belongsTo(FormasPagamentos::class, 'id_forma_pagamento');
    }
    public function RelationFormasEnvio(){
        return $this->belongsTo(FormasEnvio::class, 'id_forma_envio');
    }
    public function RelationClientes(){
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
    public function RelationEnderecos(){
        return $this->belongsTo(Enderecos::class, 'id_endereco');
    }
    public function RelationNotas(){
        return $this->belongsTo(PedidosNotas::class, 'id_nota');
    }
    public function RelationRastreios(){
        return $this->belongsTo(PedidosRastreios::class, 'id_rastreio');
    }
    public function RelationProdutos(){
        return $this->hasMany(PedidosProdutos::class, 'id_pedido', 'id');
    }
    public function RelationStatus(){
        return $this->hasMany(PedidosStatus::class, 'id_pedido');
    }
    
}
