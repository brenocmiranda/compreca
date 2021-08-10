<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagFooter extends Model
{
    protected $table = 'pag_footer';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'col-1-title', 'col-1-text', 'col-2-title', 'col-2-text', 'col-3-title', 'col-3-text', 'col-4-title', 'col-4-text', 'col-5-title', 'col-5-text', 'col-5-button', 'status', 'id_loja', 'created_at', 'updated_at'];
}
