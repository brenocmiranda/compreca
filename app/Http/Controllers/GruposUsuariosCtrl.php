<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\GruposUsuariosRqt;
use Illuminate\Http\Request;
use App\Models\GruposUsuarios;
use App\Models\Imagens;
use App\Models\Atividades;

class GruposUsuariosCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista grupos
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_grupos_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1){
            $grupos = GruposUsuarios::all()->count();
            return view('admin.grupos.lista')->with('grupos', $grupos);
        }else{
            return redirect(route('permission'));
        }  
    }
    public function Lista(){
        return datatables()->of(GruposUsuarios::all())
                    ->editColumn('status1', function(GruposUsuarios $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(GruposUsuarios $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.grupos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar grupo
                                </a>  
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.grupos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar grupo
                                </a> 
                            </div>');
                    })->rawColumns(['status1', 'acoes'])->make(true);
    }

    // Adicionando o grupos
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1){
            return view('admin.grupos.adicionar');
        }else{
            return redirect(route('permission'));
        } 
    }
    public function SalvarAdicionar(GruposUsuariosRqt $request){
        $dados = $request->all();

        $grupos = GruposUsuarios::create([
            'nome' => $dados['nome'],
            'status' => (isset($dados['status']) ? 1 : 0), 
            'visivel' => (isset($dados['visivel']) ? 1 : 0), 
            'ver_dashboard' => (isset($dados['ver_dashboard']) ? 1 : 0),
            'ver_pedidos' => (isset($dados['ver_pedidos']) ? 1 : 0),
            'edit_pedidos' => (isset($dados['edit_pedidos']) ? 1 : 0),
            'ver_carrinhos' => (isset($dados['ver_carrinhos']) ? 1 : 0),
            'edit_carrinhos' => (isset($dados['edit_carrinhos']) ? 1 : 0), 
            'ver_produtos' => (isset($dados['ver_produtos']) ? 1 : 0),
            'edit_produtos' => (isset($dados['edit_produtos']) ? 1 : 0), 
            'ver_marcas' => (isset($dados['ver_marcas']) ? 1 : 0),
            'edit_marcas' => (isset($dados['edit_marcas']) ? 1 : 0), 
            'ver_categorias' => (isset($dados['ver_categorias']) ? 1 : 0),
            'edit_categorias' => (isset($dados['edit_categorias']) ? 1 : 0), 
            'ver_variacoes' => (isset($dados['ver_variacoes']) ? 1 : 0),
            'edit_variacoes' => (isset($dados['edit_variacoes']) ? 1 : 0), 
            'ver_clientes' => (isset($dados['ver_clientes']) ? 1 : 0),
            'edit_clientes' => (isset($dados['edit_clientes']) ? 1 : 0), 
            'ver_leads' => (isset($dados['ver_leads']) ? 1 : 0),
            'edit_leads' => (isset($dados['edit_leads']) ? 1 : 0), 
            'ver_relatorios' => (isset($dados['ver_relatorios']) ? 1 : 0),
            'edit_relatorios' => (isset($dados['edit_relatorios']) ? 1 : 0), 
            'ver_lojas' => (isset($dados['ver_lojas']) ? 1 : 0),
            'edit_lojas' => (isset($dados['edit_lojas']) ? 1 : 0), 
            'ver_instituicoes' => (isset($dados['ver_instituicoes']) ? 1 : 0),
            'edit_instituicoes' => (isset($dados['edit_instituicoes']) ? 1 : 0), 
            'ver_usuarios' => (isset($dados['ver_usuarios']) ? 1 : 0),
            'edit_usuarios' => (isset($dados['edit_usuarios']) ? 1 : 0), 
            'ver_grupos_usuarios' => (isset($dados['ver_grupos_usuarios']) ? 1 : 0),
            'edit_grupos_usuarios' => (isset($dados['edit_grupos_usuarios']) ? 1 : 0), 
            'ver_configuracoes' => (isset($dados['ver_configuracoes']) ? 1 : 0),
            'edit_configuracoes' => (isset($dados['edit_configuracoes']) ? 1 : 0), 
            'ver_pagina' => (isset($dados['ver_pagina']) ? 1 : 0),
            'edit_pagina' => (isset($dados['edit_pagina']) ? 1 : 0),
            'ver_plataforma' => (isset($dados['ver_plataforma']) ? 1 : 0),
            'edit_plataforma' => (isset($dados['edit_plataforma']) ? 1 : 0),
            'ver_marketing' => (isset($dados['ver_marketing']) ? 1 : 0),
            'edit_marketing' => (isset($dados['edit_marketing']) ? 1 : 0),                          
        ]);

        Atividades::create([
            'nome' => 'Inserção de novo grupo de usuários',
            'descricao' => 'Você cadastrou um novo grupo de usuários, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.grupos', $grupos->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        if($request->acao == "modal"){
            return $grupos;
        }else{
            return redirect(route('exibir.grupos'));
        }
    }

    // Editando o grupos
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1){
            $grupos = GruposUsuarios::find($id);
            return view('admin.grupos.editar')->with('grupos', $grupos);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->except('_token');

        GruposUsuarios::where('id', $id)->update([
                            'nome' => $dados['nome'],
                            'status' => (isset($dados['status']) ? 1 : 0), 
                            'visivel' => (isset($dados['visivel']) ? 1 : 0), 
                            'ver_dashboard' => (isset($dados['ver_dashboard']) ? 1 : 0),
                            'ver_pedidos' => (isset($dados['ver_pedidos']) ? 1 : 0),
                            'edit_pedidos' => (isset($dados['edit_pedidos']) ? 1 : 0),
                            'ver_carrinhos' => (isset($dados['ver_carrinhos']) ? 1 : 0),
                            'edit_carrinhos' => (isset($dados['edit_carrinhos']) ? 1 : 0), 
                            'ver_produtos' => (isset($dados['ver_produtos']) ? 1 : 0),
                            'edit_produtos' => (isset($dados['edit_produtos']) ? 1 : 0), 
                            'ver_marcas' => (isset($dados['ver_marcas']) ? 1 : 0),
                            'edit_marcas' => (isset($dados['edit_marcas']) ? 1 : 0), 
                            'ver_categorias' => (isset($dados['ver_categorias']) ? 1 : 0),
                            'edit_categorias' => (isset($dados['edit_categorias']) ? 1 : 0), 
                            'ver_variacoes' => (isset($dados['ver_variacoes']) ? 1 : 0),
                            'edit_variacoes' => (isset($dados['edit_variacoes']) ? 1 : 0), 
                            'ver_clientes' => (isset($dados['ver_clientes']) ? 1 : 0),
                            'edit_clientes' => (isset($dados['edit_clientes']) ? 1 : 0), 
                            'ver_leads' => (isset($dados['ver_leads']) ? 1 : 0),
                            'edit_leads' => (isset($dados['edit_leads']) ? 1 : 0), 
                            'ver_relatorios' => (isset($dados['ver_relatorios']) ? 1 : 0),
                            'edit_relatorios' => (isset($dados['edit_relatorios']) ? 1 : 0), 
                            'ver_lojas' => (isset($dados['ver_lojas']) ? 1 : 0),
                            'edit_lojas' => (isset($dados['edit_lojas']) ? 1 : 0), 
                            'ver_instituicoes' => (isset($dados['ver_instituicoes']) ? 1 : 0),
                            'edit_instituicoes' => (isset($dados['edit_instituicoes']) ? 1 : 0), 
                            'ver_usuarios' => (isset($dados['ver_usuarios']) ? 1 : 0),
                            'edit_usuarios' => (isset($dados['edit_usuarios']) ? 1 : 0), 
                            'ver_grupos_usuarios' => (isset($dados['ver_grupos_usuarios']) ? 1 : 0),
                            'edit_grupos_usuarios' => (isset($dados['edit_grupos_usuarios']) ? 1 : 0), 
                            'ver_configuracoes' => (isset($dados['ver_configuracoes']) ? 1 : 0),
                            'edit_configuracoes' => (isset($dados['edit_configuracoes']) ? 1 : 0), 
                            'ver_pagina' => (isset($dados['ver_pagina']) ? 1 : 0),
                            'edit_pagina' => (isset($dados['edit_pagina']) ? 1 : 0),
                            'ver_plataforma' => (isset($dados['ver_plataforma']) ? 1 : 0),
                            'edit_plataforma' => (isset($dados['edit_plataforma']) ? 1 : 0),     
                            'ver_marketing' => (isset($dados['ver_marketing']) ? 1 : 0),
                            'edit_marketing' => (isset($dados['edit_marketing']) ? 1 : 0),               
                        ]);                         
        
        Atividades::create([
            'nome' => 'Edição de um grupo de usuários',
            'descricao' => 'Você alterou algumas informações do grupo '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.grupos', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.grupos'));
    }

    // Alterando status da marca
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1){
            $grupos = GruposUsuarios::find($id);
            if($grupos->status == 1){
                GruposUsuarios::where('id', $id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou um grupo de usuários',
                    'descricao' => 'Você desabilitou o grupo '.$grupos->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.grupos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                GruposUsuarios::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou um grupo de usuários',
                    'descricao' => 'Você habilitou o grupo '.$grupos->nome.".",
                    'icone' => 'mdi-check-outline',
                    'url' => route('editar.grupos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
        
    }
}

