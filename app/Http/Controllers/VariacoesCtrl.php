<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\VariacoesRqt;
use App\Http\Requests\VariacoesOpcoesRqt;
use Illuminate\Http\Request;
use App\Models\Variacoes;
use App\Models\Imagens;
use App\Models\VariacoesOpcoes;
use App\Models\Atividades;

class VariacoesCtrl extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }
        
    // Lista variação
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_variacoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1){
            $variacoes = (Auth::guard('admin')->user()->id_loja != null ? Variacoes::where('id_loja', Auth::guard('admin')->user()->id_loja)->count() : Variacoes::all()->count());
            return view('admin.variacoes.lista')->with('variacoes', $variacoes);
        }else{
            return redirect(route('permission'));
        }
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Variacoes::all())
                    ->editColumn('status1', function(Variacoes $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Variacoes $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.variacoes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar variação
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.variacoes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar variação
                                </a> 
                            </div>');
                    })->rawColumns(['home', 'status1', 'acoes'])->make(true);
        }else{
            return datatables()->of(Variacoes::where('id_loja', Auth::guard('admin')->user()->id_loja)->get())
                    ->editColumn('status1', function(Variacoes $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Variacoes $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.variacoes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar variação
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.variacoes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar variação
                                </a> 
                            </div>');
                    })->rawColumns(['home', 'status1', 'acoes'])->make(true);
        }
    }
    
    // Adicionando variação
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1){
            $variacoes = Variacoes::All();
            $opcoes = VariacoesOpcoes::All();
            return view('admin.variacoes.adicionar')->with('variacoes', $variacoes)->with('opcoes', $opcoes);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarAdicionar(VariacoesRqt $request){
        $dados = Variacoes::create(['nome' => $request->nome, 
                                    'status' => (isset($request->status) ? 1 : 0),  
                                    'id_opcao' => $request->id_opcao, 
                                    'valor' => $request->valor,
                                    'id_loja' => Auth::guard('admin')->user()->id_loja, 
                                ]);

        Atividades::create([
            'nome' => 'Inserção de nova variação',
            'descricao' => 'Você cadastrou uma nova variação, '.$request->nome.".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.variacoes', $dados->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
        
        if($request->acao == "modal"){
            return $dados;
        }else{
            return redirect(route('exibir.variacoes'));
        }         
    }

    // Editando variação
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1){
            $variacao = Variacoes::find($id);
            $opcoes = VariacoesOpcoes::All();
            return view('admin.variacoes.editar')->with('variacao', $variacao)->with('opcoes', $opcoes);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function SalvarEditar(Request $request, $id){
         $dados = Variacoes::where('id', $id)->update(['nome' => $request->nome, 
                                    'status' => (isset($request->status) ? 1 : 0),  
                                    'id_opcao' => $request->id_opcao, 
                                    'valor' => $request->valor,
                                ]);

         Atividades::create([
            'nome' => 'Edição de uma variação',
            'descricao' => 'Você alterou algumas informações da variação '.$request->nome.".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.variacoes', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.variacoes'));
    }

    // Criando nova opcao
    public function SalvarOpcao(VariacoesOpcoesRqt $request){
        $opcao = VariacoesOpcoes::create(['nome' => $request->nome]);
        $variacoes = VariacoesOpcoes::All();

        Atividades::create([
            'nome' => 'Inserção de nova opção de variação',
            'descricao' => 'Você cadastrou uma nova opção de variação, '.$request->nome.".",
            'icone' => 'mdi-plus-thick',
            'url' => 'javascript:void(0)',
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return $variacoes;
    }

     // Alterando status da variação
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1){
            $variacoes = Variacoes::find($id);
            if($variacoes->status == 1){
                Variacoes::where('id', $id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou uma variação',
                    'descricao' => 'Você desabilitou a variação '.$variacoes->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.variacoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Variacoes::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou uma variação',
                    'descricao' => 'Você habilitou a variação '.$variacoes->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.variacoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
    }

    // Detalhes da variação
    public function Detalhes($id){
        $variacao = Variacoes::find($id);
        return response()->json($variacao);
    }
}