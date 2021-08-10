<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
   	protected $table = 'enderecos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'outros', 'status', 'destinatario', 'cep', 'endereco', 'numero', 'complemeto', 'referencia', 'bairro', 'cidade', 'estado', 'id_cliente', 'created_at', 'updated_at'];
}
