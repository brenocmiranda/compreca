<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPagamento extends Model
{
    protected $table = 'formas_pagamento';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'cod', 'created_at', 'updated_at'];
}
