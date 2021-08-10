<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefones extends Model
{
    protected $table = 'telefones';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'tel_contato', 'tel_celular', 'tel_whatsapp', 'id_cliente', 'created_at', 'updated_at'];
}
