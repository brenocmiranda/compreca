<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasEnvio extends Model
{
    protected $table = 'formas_envio';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'valor_envio', 'created_at', 'updated_at'];
}
