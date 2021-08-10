<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPagamentos extends Model
{
    protected $table = 'formas_pagamento';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'cod', 'created_at', 'updated_at'];
}
