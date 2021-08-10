<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GruposUsuarios extends Model
{
    protected $table = 'grupos_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'visivel', 'status', 'ver_dashboard', 'ver_pedidos', 'edit_pedidos', 'ver_carrinhos', 'edit_carrinhos', 'ver_produtos', 'edit_produtos', 'ver_marcas', 'edit_marcas', 'ver_categorias', 'edit_categorias', 'ver_variacoes', 'edit_variacoes', 'ver_clientes', 'edit_clientes', 'ver_leads', 'edit_leads', 'ver_relatorios', 'edit_relatorios', 'ver_lojas', 'edit_lojas', 'ver_instituicoes', 'edit_instituicoes', 'ver_usuarios', 'edit_usuarios', 'ver_grupos_usuarios', 'edit_grupos_usuarios', 'ver_configuracoes', 'edit_configuracoes', 'ver_pagina', 'edit_pagina', 'ver_plataforma', 'edit_plataforma', 'ver_marketing', 'edit_marketing','created_at', 'updated_at'];
}
