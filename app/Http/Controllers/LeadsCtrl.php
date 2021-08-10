<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LeadsRqt;
use App\Models\Leads;
use App\Models\Atividades;

class LeadsCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // Listando produtos
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_leads == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1){
            $leads = (Auth::guard('admin')->user()->id_loja != null ? Leads::where('id_loja', Auth::guard('admin')->user()->id_loja)->count() : Leads::all()->count());
            return view('admin.leads.lista')->with('leads', $leads);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Leads::all())
                    ->editColumn('acoes', function(Leads $dados){ 
                        return '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                            </div>';
                    })->rawColumns(['acoes'])->make(true);
        }else{
            return datatables()->of(Leads::where('id_loja', Auth::guard('admin')->user()->id_loja)->get())
                    ->editColumn('acoes', function(Leads $dados){ 
                        return '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                            </div>';
                    })->rawColumns(['acoes'])->make(true);
        }
    }

    // Adicionando usuario
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1){
            return view('admin.leads.adicionar');
        }else{
            return redirect(route('permission'));
        }	
    }
    public function SalvarAdicionar(LeadsRqt $request){
        $dados = $request->all();

        // Inserindo o usuario
        $leads = Leads::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'tel_contato' => (isset($dados['tel_contato']) ? $dados['tel_contato'] : null),
            'id_loja' => Auth::guard('admin')->user()->id_loja,
        ]);

        Atividades::create([
            'nome' => 'Inserção de novo lead',
            'descricao' => 'Você cadastrou um novo lead, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.leads', $leads->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
            
        return redirect(route('exibir.leads'));
    }

    // Editando usuario
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1){
            $leads = Leads::find($id);
            return view('admin.leads.editar')->with('leads', $leads);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->all();

        $leads = Leads::find($id);
        Leads::where('id', $id)->update([
				            'nome' => $dados['nome'],
				            'email' => $dados['email'],
				            'tel_contato' => (isset($dados['tel_contato']) ? $dados['tel_contato'] : null),                       
                        ]);

        Atividades::create([
            'nome' => 'Edição de um lead',
            'descricao' => 'Você alterou algumas informações do lead '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.leads', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.leads'));
    }
}
