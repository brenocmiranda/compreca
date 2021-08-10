<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientesRqt;
use App\Models\Clientes;
use App\Models\Telefones;
use App\Models\Enderecos;
use App\Models\Imagens;
use App\Models\Atividades;

class ClientesCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // Listando produtos
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_clientes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1){
            $clientes = Clientes::all()->count();
            return view('admin.clientes.lista')->with('clientes', $clientes);
        }else{
            return redirect(route('permission'));
        }
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Clientes::all())
                    ->editColumn('status1', function(Clientes $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Clientes $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.clientes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar usuário
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="resetarSenha('.$dados->id.')">
                                    <i class="mdi mdi-lock-reset"></i> Resetar senha
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.clientes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar usuário
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="resetarSenha('.$dados->id.')">
                                    <i class="mdi mdi-lock-reset"></i> Resetar senha
                                </a> 
                            </div>');
                    })->rawColumns(['usuario', 'loja', 'grupo', 'status1', 'acoes'])->make(true);
        }else{
            return datatables()->of(Clientes::all())
                    ->editColumn('status1', function(Clientes $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Clientes $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.clientes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar usuário
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="resetarSenha('.$dados->id.')">
                                    <i class="mdi mdi-lock-reset"></i> Resetar senha
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.clientes', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar usuário
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="resetarSenha('.$dados->id.')">
                                    <i class="mdi mdi-lock-reset"></i> Resetar senha
                                </a> 
                            </div>');
                    })->rawColumns(['usuario', 'loja', 'grupo', 'status1', 'acoes'])->make(true);
        }
        
    }

    // Adicionando usuario
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1){
            return view('admin.clientes.adicionar');
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarAdicionar(ClientesRqt $request){
        $dados = $request->all();

        // Inserindo o clientes
        $clientes = Clientes::create([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'tipo' => $dados['tipo'],
            'documento' => $dados['documento'],
            'data_nascimento' => (isset($dados['data_nascimento']) ? $dados['data_nascimento'] : null),
            'email' => $dados['email'],
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => (isset($dados['password']) ? Hash::make($dados['password']) : Hash::make('compreca123')), 
            'apelido' => $dados['apelido'],
            'sexo' => $dados['sexo'], 
            '_token' => $dados['_token']
        ]);
            
        $telefone = Telefones::create([
        		'nome' => 'Telefone principal',
        		'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $dados['telefone']))),
        		'id_cliente' => $clientes->id
        ]);

        if(isset($dados['cep'])){
        	foreach($dados['cep'] as $key => $enderecos){
        		// Inserindo o clientes
		        $enderecos = Enderecos::create([
		            'nome' => 'Endereço'.$key,
		            'status' => 0,
		            'destinatario' => $dados['destinatario'][$key],
		            'cep' => $dados['cep'][$key],
		            'endereco' => $dados['endereco'][$key],
		            'numero' => $dados['numero'][$key],
		            'complemento' => (isset($dados['complemento'][$key]) ? $dados['complemento'][$key] : null),
		            'referencia' => (isset($dados['referencia'][$key]) ? $dados['referencia'][$key] : null),
		            'bairro' => $dados['bairro'][$key],
		            'cidade' => $dados['cidade'][$key],
		            'estado' => $dados['estado'][$key],
		            'id_cliente' => $clientes->id
		        ]);	
        	}
        }

        Atividades::create([
            'nome' => 'Inserção de novo cliente',
            'descricao' => 'Você cadastrou um novo cliente, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.clientes', $clientes->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.clientes'));
    }

    // Editando clientes
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1){
            $clientes = Clientes::find($id);
            $enderecos = Enderecos::where('id_cliente', $id)->where('status', 1)->get();
            return view('admin.clientes.editar')->with('clientes', $clientes);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->all();

        $clientes = Clientes::find($id);
        Clientes::where('id', $id)->update([
				            'status' => (isset($dados['status']) ? 1 : 0), 
				            'nome' => $dados['nome'],
				            'tipo' => $dados['tipo'],
				            'documento' => $dados['documento'],
				            'data_nascimento' => (isset($dados['data_nascimento']) ? $dados['data_nascimento'] : null),
				            'email' => $dados['email'],
				            'email_verified_at' => date('Y-m-d H:i:s'),
				            'password' => (isset($dados['password']) ? Hash::make($dados['password']) : $clientes->password), 
				            'apelido' => $dados['apelido'],
				            'sexo' => $dados['sexo'], 
				            '_token' => $dados['_token']                         
                        ]);

        $telefones = Telefones::where('id_cliente', $id)->whereNotNull('tel_contato')->get();
        if(!isset($telefones)){
            Telefones::where('id_cliente', $id)->update([
                'nome' => 'Telefone principal',
                'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $dados['telefone']))),
                'id_cliente' => $id
            ]);
        }else{
            Telefones::create([
                'nome' => 'Telefone principal',
                'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $dados['telefone']))),
                'id_cliente' => $id
                ]);
        }

        Enderecos::where('id_cliente', $id)->update(['status' => 0]);
        if(isset($request->cep)){
            foreach($request->cep as $key => $enderecos){
                if($request->id_endereco[$key]){
                    Enderecos::find($request->id_endereco[$key])->update([
                        'nome' => $request->nomeEndereco[$key],
                        'status' => 1,
                        'destinatario' => $request->destinatario[$key],
                        'cep' => str_replace("-", "", $request->cep[$key]),
                        'endereco' => $request->endereco[$key],
                        'numero' => $request->numero[$key],
                        'complemento' => (isset($request->complemento[$key]) ? $request->complemento[$key] : null),
                        'referencia' => (isset($request->referencia[$key]) ? $request->referencia[$key] : null),
                        'bairro' => (isset($request->bairro[$key]) ? $request->bairro[$key] : $request->bairro1[$key]),
                        'cidade' => (isset($request->cidade[$key]) ? $request->cidade[$key] : $request->cidade1[$key]),
                        'estado' => (isset($request->estado[$key]) ? $request->estado[$key] : $request->estado1[$key]),
                        'id_cliente' => $id
                    ]); 
                }else{
                    Enderecos::create([
                        'nome' => $request->nomeEndereco[$key],
                        'status' => 1,
                        'destinatario' => $request->destinatario[$key],
                        'cep' => $request->cep[$key],
                        'endereco' => $request->endereco[$key],
                        'numero' => $request->numero[$key],
                        'complemento' => (isset($request->complemento[$key]) ? $request->complemento[$key] : null),
                        'referencia' => (isset($request->referencia[$key]) ? $request->referencia[$key] : null),
                        'bairro' => (isset($request->bairro[$key]) ? $request->bairro[$key] : $request->bairro1[$key]),
                        'cidade' => (isset($request->cidade[$key]) ? $request->cidade[$key] : $request->cidade1[$key]),
                        'estado' => (isset($request->estado[$key]) ? $request->estado[$key] : $request->estado1[$key]),
                        'id_cliente' => $id
                    ]); 
                    
                }
            }
        }

        Atividades::create([
            'nome' => 'Edição de um cliente',
            'descricao' => 'Você alterou algumas informações do cliente '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.clientes', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.clientes'));
    }

    // Alterando status produtos
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1){
            $clientes = Clientes::find($id);
            if($clientes->status == 1){
                Clientes::find($id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou um cliente',
                    'descricao' => 'Você desabilitou o cliente '.$clientes->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.clientes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Clientes::find($id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou um cliente',
                    'descricao' => 'Você habilitou o cliente '.$clientes->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.clientes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
        
    }

    // Alterando status produtos
    public function Resetar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1){
            $clientes = Clientes::find($id)->update(['password', '$2y$10$iWTSpqjrpbiUMK2hv5LqmO01XUfJKnWc1cnQuk/LX5heKBKt1EwlS']);
            Atividades::create([
                    'nome' => 'Resetou a senha de um cliente',
                    'descricao' => 'Você resetou a senha de acesso do cliente '.$clientes->nome.".",
                    'icone' => 'mdi-lock-reset',
                    'url' => route('editar.clientes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
    }
}
