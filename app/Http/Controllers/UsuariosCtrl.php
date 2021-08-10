<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRqt;
use App\Http\Requests\UsuariosRqt;
use App\Http\Requests\PerfilRqt;
use App\Models\Atividades;
use App\Models\Usuarios;
use App\Models\GruposUsuarios;
use App\Models\Lojas;
use App\Models\Categorias;
use App\Models\Instituicoes;
use App\Models\Imagens;
use App\Models\Emails;
use Mail;

class UsuariosCtrl extends Controller
{

	#-------------------------------------------------------------------
	# Informações ocultas
	#-------------------------------------------------------------------

    // Login
	public function Login(){
		if (Auth::guard('admin')->check()) {
			return redirect(route('home'));
		}else{
			return view('admin.system.login');
		}
	}
	// Autenticação de usuário
	public function Redirecionar(LoginRqt $FormLogin){
        Auth::guard('admin')->logoutOtherDevices($FormLogin->password);

		if (Auth::guard('admin')->attempt(['email' => $FormLogin->email, 'password' => $FormLogin->password, 'status' => 1], $FormLogin->remember)){
	       return redirect()->intended(route('home'));	

        // Não ativo
        }elseif(Usuarios::where('email', $FormLogin->email)->where('status', 0)->first()){
            \Session::flash('login', array(
                'class' => 'danger',
                'mensagem' => 'O usuário encontra-se desativado.'
            ));
            return redirect(route('login'));

        // Senha não confere
    	}elseif(Usuarios::where('email', $FormLogin->email)->first()){
			\Session::flash('login', array(
				'class' => 'danger',
				'mensagem' => 'A senha inserida não confere.'
			));
			return redirect(route('login'));
            
        // E-mail não confere
    	}else{
			\Session::flash('login', array(
				'class' => 'danger',
				'mensagem' => 'E-mail não cadastrado.'
			));
			return redirect(route('login'));
		}	
        
	}
    // Sair
    public function Sair(){
        Auth::guard('admin')->logout();
        return redirect(route('login'));
    }
    // Página inicial
	public function Home(){
        if (Auth::guard('admin')->check()){
            return view('admin.system.home');
        }else{
            return redirect(route('login'));
        }
    }

	

	#-------------------------------------------------------------------
	# Template administrador
	#-------------------------------------------------------------------
	
	// Listando usuários
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1){
            $usuarios = (Auth::guard('admin')->user()->id_loja != null ? Usuarios::where('id_loja', Auth::user()->id_loja)->count() : Usuarios::all()->count());
            return view('admin.usuarios.lista')->with('usuarios', $usuarios);
        }else{
            return redirect(route('permission'));
        }
    }
    public function Lista(){
        return datatables()->of(Usuarios::where('id', '<>', Auth::id())->get())
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
                            <a class="dropdown-item has-icon" href="'.route('editar.usuarios', $dados->id).'">
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
                            <a class="dropdown-item has-icon" href="'.route('editar.usuarios', $dados->id).'">
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

    // Adicionando usuario
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1){
            $lojas = Lojas::where('status', 1)->get();
            $grupos = GruposUsuarios::where('status', 1)->get();
            $categorias = Categorias::where('status', 1)->get();
            $instituicoes = Instituicoes::where('status', 1)->get();
    	   return view('admin.usuarios.adicionar')->with('lojas', $lojas)->with('grupos', $grupos)->with('categorias', $categorias)->with('instituicoes', $instituicoes);
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
            'id_loja' => (isset($dados['id_loja']) ? $dados['id_loja'] : null),
            'id_grupo' => $dados['id_grupo'],  
            '_token' => $dados['_token'],                   
        ]);

        Atividades::create([
            'nome' => 'Inserção de novo usuário',
            'descricao' => 'Você cadastrou um novo usuário, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.usuarios', $usuario->id),
            'id_usuario' => Auth::id()
        ]);
        return redirect(route('exibir.usuarios'));
    }

    // Editando usuario
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1){
            $usuarios = Usuarios::find($id);
            $lojas = Lojas::where('status', 1)->get();
            $grupos = GruposUsuarios::where('status', 1)->get();
            $instituicoes = Instituicoes::where('status', 1)->get();
            return view('admin.usuarios.editar')->with('usuarios', $usuarios)->with('lojas', $lojas)->with('grupos', $grupos)->with('instituicoes', $instituicoes);
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
                            'id_loja' => (isset($dados['id_loja']) ? $dados['id_loja'] : null),
                            'id_grupo' => $dados['id_grupo'],  
                            '_token' => $dados['_token'],                         
                        ]);

        Atividades::create([
            'nome' => 'Edição de um usuário',
            'descricao' => 'Você alterou algumas informações do usuário '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.usuarios', $id),
            'id_usuario' => Auth::id()
        ]);

        return redirect(route('exibir.usuarios'));
    }

    // Alterando status produtos
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1){
            $usuarios = Usuarios::find($id);
            if($usuarios->status == 1){
                Usuarios::find($id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou um usuário',
                    'descricao' => 'Você desabilitou o usuário '.$usuarios->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.usuarios', $id),
                    'id_usuario' => Auth::id()
                ]);
            }else{
                Usuarios::find($id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou um usuário',
                    'descricao' => 'Você habilitou o usuário '.$usuarios->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.usuarios', $id),
                    'id_usuario' => Auth::id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
        
    }

    // Resetando a senha do usuário
    public function Resetar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1){
            $usuarios = Usuarios::find($id)->update(['password', Hash::make('compreca123')]);
            Atividades::create([
                    'nome' => 'Resetou a senha de um usuário',
                    'descricao' => 'Você resetou a senha de acesso do usuário '.$usuarios->nome.".",
                    'icone' => 'mdi-lock-reset',
                    'url' => route('editar.usuarios', $id),
                    'id_usuario' => Auth::id()
                ]);
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
    }


    #-------------------------------------------------------------------
	# Template usuários
	#-------------------------------------------------------------------

    // Perfil do usuário
	public function Perfil(){
		$usuarios = Usuarios::select('nome', 'documento', 'id_loja', 'id_grupo', 'email')->find(Auth::guard('admin')->id());
		return view('admin.system.perfil')->with('usuarios', $usuarios);
	}

    // Salvar perfil
    public function SalvarPerfil(PerfilRqt $request){
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

        $usuario = Usuarios::find(Auth::guard('admin')->id());
        Usuarios::find(Auth::guard('admin')->id())->update([ 
                            'nome' => $dados['nome'],
                            'documento' => $dados['documento'],
                            'email' => $dados['email'],
                            'password' => (isset($dados['password_confirmation']) ? Hash::make($dados['password_confirmation']) : $usuario->password),
                            'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : $usuario->id_imagem)
                        ]);

        \Session::flash('alteracao', array(
            'class' => 'success',
            'mensagem' => 'Informações alteradas com sucesso.'
        ));

        Atividades::create([
                'nome' => 'Alterações no perfil',
                'descricao' => 'Você alterou algumas informações no seu perfil.',
                'icone' => 'mdi-update',
                'url' => route('perfil', Auth::guard('admin')->id()),
                'id_usuario' => Auth::guard('admin')->id()
            ]);

        return redirect(route('perfil'));
    }

	// Recuperação de senha
	public function Forwarding(Request $request){
		$dados = Usuarios::where('email', $request->email)->first();
		if(!empty($dados->first())){
			Mail::send('admin.system.emails.recuperacao', ['user' => $dados], function ($m) use ($dados) {
				$m->from('suporte@compreca.com.br', 'CompreCá Marketplace');
				$m->to($dados->email, $dados->nome)->subject('Redefinição de senha');
			});
			return response()->json(['success' => true]);
		}else{
			return false;
		}	
	}
	public function NewPassword($token){
		$user = Usuarios::where('_token', $token)->select('id', 'nome', 'id_imagem')->first();
		Auth::guard('admin')->logout();
		if(isset($user)){
			return view('admin.system.password')->with('user', $user);
		}else{
			\Session::flash('login', array(
				'class' => 'danger',
				'mensagem' => 'Senha já redefinida.'
			));
			return redirect(route('login'));
		}
	}
	public function Alterar(Request $request){
		$dados = Usuarios::where('id', $request->id)->update([
            'password' => Hash::make($request->confirmpassword), 
            '_token' => md5(rand())
        ]);

        Atividades::create([
                'nome' => 'Redefinição de senha',
                'descricao' => 'Você solicitou a redefinição de senha e a modificou.',
                'icone' => 'mdi-textbox-password',
                'url' => route('perfil', Auth::guard('admin')->id()),
                'id_usuario' => Auth::guard('admin')->id()
            ]);

		\Session::flash('login', array(
			'class' => 'success',
			'mensagem' => 'Senha alterada com sucesso, faça o login.'
		));
		return redirect(route('login'));
	}
	
    // Todas as atividades do usuário
    public function Atividades(){
        $dados = Atividades::where('id_usuario', Auth::guard('admin')->id())->where('status', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.system.atividades')->with('dados', $dados);
    }

    // Erro de autorização das permissões
    public function Permissoes(){
        return view('admin.system.permission');
    }
}		