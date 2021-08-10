<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagMenu extends Model
{
    protected $table = 'pag_menu';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'tagName', 'order', 'status', 'created_at', 'updated_at'];
}
