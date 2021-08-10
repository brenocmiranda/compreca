<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosStatus extends Model
{
    protected $table = 'pedidos_status';
    protected $primaryKey = 'id';
    protected $fillable = ['id','observacoes', 'id_pedido', 'id_status', 'created_at', 'updated_at'];

    public function RelationDados(){
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }

}
