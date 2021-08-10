<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagSections extends Model
{
    protected $table = 'pag_sections';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'section', 'background', 'title', 'carousel', 'qtdCarousel', 'container', 'style', 'status', 'width_card', 'height_card', 'style_card', 'type', 'created_at', 'updated_at'];

    public function RelationCards(){
    	return $this->hasMany(PagSectionsCard::class, 'section', 'id');
    }

}
