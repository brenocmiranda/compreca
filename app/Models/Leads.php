<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table = 'leads';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'email', 'tel_contato', 'created_at', 'updated_at'];
}
