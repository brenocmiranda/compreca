<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagSlider extends Model
{
    protected $table = 'pag_slider';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'title', 'text', 'text_button', 'tagName', 'escurecer', 'status', 'id_imagem', 'created_at', 'updated_at'];

    public function RelationImagens(){
        return $this->belongsTo(Imagens::class, 'id_imagem');
    }
}
