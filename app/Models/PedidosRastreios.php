<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosRastreios extends Model
{
    protected $table = 'pedidos_rastreio';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'cod_rastreamento', 'link_rastreamento', 'observacoes', 'created_at', 'updated_at'];
}
