<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\UsuariosRqt;
use Illuminate\Http\Request;
use App\Models\Imagens;
use App\Models\Lojas;
use App\Models\Usuarios;
use App\Models\GruposUsuarios;
use App\Models\Atividades;

class ConfiguracoesCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // Configurações
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_configuracoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_condiguracoes == 1){
    	   return view('admin.configuracoes.geral');
        }else{
            return redirect(route('permission'));
        }
    }

    // Geral
    public function Geral(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_configuracoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_condiguracoes == 1){
            $loja = Lojas::where('id', Auth::guard('admin')->user()->id_loja)->first();
        	return view('admin.configuracoes.loja')->with('loja', $loja);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarGeral(Request $request){
        $dados = $request->except('_token');
        $imagens = (isset($dados['id_imagem']) ? $dados['id_imagem'] : null);
        if(!empty($imagens)){
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('id_imagem') && $request->file('id_imagem')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
                // Recupera a extensão do arquivo
                $extension = $request->id_imagem->extension();
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $upload = $request->id_imagem->storeAs('lojas', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/lojas/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'lojas']);
            $dados['id_imagem'] = $imagem->id;       
        }


        $imagens = (isset($dados['id_logomarca']) ? $dados['id_logomarca'] : null);
        if(!empty($imagens)){
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('id_logomarca') && $request->file('id_logomarca')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
                // Recupera a extensão do arquivo
                $extension = $request->id_logomarca->extension();
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $upload = $request->id_logomarca->storeAs('lojas', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/lojas/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'lojas']);
            $dados['id_logomarca'] = $imagem->id;       
        }

        $info = Lojas::find(Auth::guard('admin')->user()->id_loja);
        $lojas = Lojas::where('id', Auth::guard('admin')->user()->id_loja)->update([
            'nome' => $dados['nome'],
            'descricao' => (isset($dados['descricao']) ? $dados['descricao'] : null), 
            'cep' => $dados['cep'], 
            'endereco' => $dados['endereco'],
            'numero' => $dados['numero'],
            'complemento' => (isset($dados['complemento']) ? $dados['complemento'] : null), 
            'bairro' => (isset($dados['bairro']) ? $dados['bairro'] : $dados['bairro1']),
            'cidade' => (isset($dados['cidade']) ? $dados['cidade'] : $dados['cidade1']),
            'estado' => (isset($dados['estado']) ? $dados['estado'] : $dados['estado1']),
            'telefone' => $dados['telefone'],
            'email' => $dados['email'],
            'url_instagram' => $dados['url_instagram'],
            'url_facebook' => $dados['url_facebook'],
            'url_whatsapp' => $dados['url_whatsapp'], 
            'id_logomarca' => (isset($dados['id_logomarca']) ? $dados['id_logomarca'] : $info->id_logomarca),
            'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : $info->id_imagem),                   
        ]);

        Atividades::create([
            'nome' => 'Configurações da loja',
            'descricao' => 'Você alterou algumas informações da sua loja.',
            'icone' => 'mdi-cog-outline',
            'url' => route('configuracoes.geral', Auth::guard('admin')->user()->id_loja),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
        
        return redirect(route('configuracoes.geral'));
    }


    // Usuarios
    public function Usuarios(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_configuracoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1){
            $usuarios = (Auth::guard('admin')->user()->id_loja != null ? Usuarios::where('id_loja', Auth::guard('admin')->user()->id_loja)->where('id', '<>', Auth::guard('admin')->id())->count() : Usuarios::all()->count());
            return view('admin.configuracoes.usuarios.lista')->with('usuarios', $usuarios);
        }else{
            return redirect(route('permission'));
        }
    }
    public function Lista(){
        return datatables()->of(Usuarios::where('id_loja', Auth::guard('admin')->user()->id_loja)->where('id', '<>', Auth::guard('admin')->id())->get())
                ->editColumn('usuario', function(Usuarios $dados){ 
                    return '<div class="d-flex my-2"><div class="my-auto col-3 px-3"><img src="'.(isset($dados->RelationImagens) ? asset('storage/app/'.$dados->RelationImagens->caminho.'?'.rand()) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 55px; width: 55px;" class="rounded" ></div><div class="text-left my-auto"><h6 class="text-decoration-none "><b>'.$dados->nome.'</b></h6></div></div>';
                })
                ->editColumn('loja', function(Usuarios $dados){
                    return (isset($dados->RelationLojas) ? $dados->RelationLojas->nome : 'Não atribuido');
                })
                ->editColumn('grupo', function(Usuarios $dados){
                    return (isset($dados->RelationGrupo) ? $dados->RelationGrupo->nome : 'Não atribuido');
                })
                ->editColumn('status1', function(Usuarios $dados){
                    return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                })
                ->editColumn('acoes', function(Usuarios $dados){ 
                    return ($dados->status == 1 ? '
                        <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                            <a class="dropdown-item has-icon" href="'.route('configuracoes.editar.usuarios', $dados->id).'">
                                <i class="mdi mdi-pencil"></i> Editar informações
                            </a> 
                            <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                <i class="mdi mdi-close"></i> Desativar usuário
                            </a> 
                        </div>'
                        : 
                        '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                            <a class="dropdown-item has-icon" href="'.route('configuracoes.editar.usuarios', $dados->id).'">
                                <i class="mdi mdi-pencil"></i> Editar informações
                            </a> 
                            <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                <i class="mdi mdi-check"></i> Ativar usuário
                            </a> 
                        </div>');
                })->rawColumns(['usuario', 'loja', 'grupo', 'status1', 'acoes'])->make(true);
    }

    // Adicionando usuario
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1){
            $lojas = Lojas::where('status', 1)->get();
            $grupos = GruposUsuarios::where('status', 1)->get();
           return view('admin.configuracoes.usuarios.adicionar')->with('lojas', $lojas)->with('grupos', $grupos);
        }else{
           return redirect(route('permission'));
        }
    }
    public function SalvarAdicionar(UsuariosRqt $request){
        $dados = $request->all();
        $imagens = (isset($dados['id_imagem']) ? $dados['id_imagem'] : null);
        if(!empty($imagens)){
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('id_imagem') && $request->file('id_imagem')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
                // Recupera a extensão do arquivo
                $extension = $request->id_imagem->extension();
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $upload = $request->id_imagem->storeAs('usuarios', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/instituicoes/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'usuarios']);
            $dados['id_imagem'] = $imagem->id;       
        }else{
            if(is_dir(getcwd().'/storage/app/usuarios')){
                $name = uniqid(date('HisYmd')).'.png';
                copy(getcwd().'/public/admin/img/user.png', getcwd().'/storage/app/usuarios/'.$name);
                $caminho = 'usuarios/'.$name;
                $imagem = Imagens::create(['caminho' =>  $caminho, 'tipo' => 'usuarios']);
                $dados['id_imagem'] = $imagem->id; 
            }else{
                mkdir(getcwd().'/storage/app/usuarios', 0755);
                $name = uniqid(date('HisYmd')).'.png';
                copy(getcwd().'/public/admin/img/user.png', getcwd().'/storage/app/usuarios/'.$name);
                $caminho = 'usuarios/'.$name;
                $imagem = Imagens::create(['caminho' =>  $caminho, 'tipo' => 'usuarios']);
                $dados['id_imagem'] = $imagem->id; 
            }  
        }

        // Inserindo o usuario
        $usuario = Usuarios::create([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'documento' => $dados['documento'],
            'email' => $dados['email'],
            'password' => Hash::make('compreca123'),
            'id_imagem' => $dados['id_imagem'],
            'id_loja' => Auth::guard('admin')->user()->id_loja,
            'id_grupo' => $dados['id_grupo'],  
            '_token' => $dados['_token'],                   
        ]);

        Atividades::create([
            'nome' => 'Inserção de novo usuário',
            'descricao' => 'Você cadastrou um novo usuário, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('configuracoes.adicionar.usuarios', $usuario->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('configuracoes.usuarios'));
    }

    // Editando usuario
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1){
            $usuarios = Usuarios::find($id);
            $lojas = Lojas::where('status', 1)->get();
            $grupos = GruposUsuarios::where('status', 1)->get();
            return view('admin.configuracoes.usuarios.editar')->with('usuarios', $usuarios)->with('lojas', $lojas)->with('grupos', $grupos);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->all();

        $imagens = (isset($dados['id_imagem']) ? $dados['id_imagem'] : null);
        if(!empty($imagens)){
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('id_imagem') && $request->file('id_imagem')->isValid()) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
                // Recupera a extensão do arquivo
                $extension = $request->id_imagem->extension();
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $upload = $request->id_imagem->storeAs('usuarios', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/instituicoes/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'usuarios']);
            $dados['id_imagem'] = $imagem->id;       
        }

        $usuario = Usuarios::find($id);
        Usuarios::where('id', $id)->update([
                            'status' => (isset($dados['status']) ? 1 : 0), 
                            'nome' => $dados['nome'],
                            'documento' => $dados['documento'],
                            'email' => $dados['email'],
                            'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : $usuario->id_imagem),
                            'id_loja' => Auth::guard('admin')->user()->id_loja,
                            'id_grupo' => $dados['id_grupo'],  
                            '_token' => $dados['_token'],                         
                        ]);

        Atividades::create([
            'nome' => 'Edição de um usuário',
            'descricao' => 'Você alterou algumas informações do usuário '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('configuracoes.editar.usuarios', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('configuracoes.usuarios'));
    }

    // Alterando status produtos
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1){
            $usuarios = Usuarios::find($id);
            if($usuarios->status == 1){
                Usuarios::find($id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou um usuário',
                    'descricao' => 'Você desabilitou o usuário '.$usuarios->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('configuracoes.editar.usuarios', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Usuarios::find($id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou um usuário',
                    'descricao' => 'Você habilitou o usuário '.$usuarios->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('configuracoes.editar.usuarios', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
        
    }

    // Integrações
    public function Integracoes(){
       return view('admin.configuracoes.integracoes');
    }
}
