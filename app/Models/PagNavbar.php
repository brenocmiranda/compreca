<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagNavbar extends Model
{
    protected $table = 'pag_navbar';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'mensagem', 'facebook', 'instagram', 'youtube', 'search', 'tagName', 'status', 'created_at', 'updated_at'];
}
