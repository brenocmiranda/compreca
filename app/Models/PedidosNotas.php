<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosNotas extends Model
{
    protected $table = 'pedidos_notas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'numero_nota', 'data_emissao', 'numero_serie', 'chave', 'url_nota', 'created_at', 'updated_at'];
}
