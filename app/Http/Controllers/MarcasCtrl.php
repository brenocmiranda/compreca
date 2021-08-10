<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\MarcasRqt;
use Illuminate\Http\Request;
use App\Models\Marcas;
use App\Models\Imagens;
use App\Models\Atividades;

class MarcasCtrl extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista marca
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_marcas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1){
            $marcas = (Auth::guard('admin')->user()->id_loja != null ? Marcas::where('id_loja', Auth::guard('admin')->user()->id_loja)->count() : Marcas::all()->count());
            return view('admin.marcas.lista')->with('marcas', $marcas);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Marcas::all())
                    ->editColumn('imagem', function(Marcas $dados){ 
                        return '<div class="m-auto"><img src="'.( isset($dados->RelationImagens->caminho) ? asset('storage/app/'.$dados->RelationImagens->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 45px; width: 45px;" class="rounded" ></div><div class="text-left my-auto"></div>';
                    })
                    ->editColumn('marca', function(Marcas $dados){ 
                        return '<h6 class="text-decoration-none mb-0"><b>'.$dados->nome.'</b></h6>';
                    })
                    ->editColumn('status1', function(Marcas $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Marcas $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.marcas', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar marca
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.marcas', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar marca
                                </a> 
                            </div>');
                    })->rawColumns(['imagem', 'marca', 'status1', 'acoes'])->make(true);
        }else{
            return datatables()->of(Marcas::where('id_loja', Auth::guard('admin')->user()->id_loja)->get())
                    ->editColumn('imagem', function(Marcas $dados){ 
                        return '<div class="m-auto"><img src="'.( isset($dados->RelationImagens->caminho) ? asset('storage/app/'.$dados->RelationImagens->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 45px; width: 45px;" class="rounded" ></div><div class="text-left my-auto"></div>';
                    })
                    ->editColumn('marca', function(Marcas $dados){ 
                        return '<h6 class="text-decoration-none mb-0"><b>'.$dados->nome.'</b></h6>';
                    })
                    ->editColumn('status1', function(Marcas $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Marcas $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.marcas', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar marca
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.marcas', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar marca
                                </a> 
                            </div>');
                    })->rawColumns(['imagem', 'marca', 'status1', 'acoes'])->make(true);
        }
    }

    // Adicionando a marca
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1){
            $marcas = Marcas::all();
            return view('admin.marcas.adicionar')->with('marcas', $marcas);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function SalvarAdicionar(MarcasRqt $request){
        $dados = $request->except(['_token', 'acao']);
        
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
                $upload = $request->id_imagem->storeAs('marcas', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/marcas/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'marcas']);
            $dados['id_imagem'] = $imagem->id;       
        }

        $marca = Marcas::create([
            'nome' => $dados['nome'],
            'status' => (isset($dados['status']) ? 1 : 0), 
            'descricao' => $dados['descricao'],
            'id_imagem' => $dados['id_imagem'],
            'id_loja' => Auth::guard('admin')->user()->id_loja,                         
        ]);

        Atividades::create([
            'nome' => 'Inserção de nova marca',
            'descricao' => 'Você cadastrou uma nova marca, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.marcas', $marca->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        if($request->acao == "modal"){
            return $marca;
        }else{
            return redirect(route('exibir.marcas'));
        }
    }

    // Editando a marca
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1){
            $marca = Marcas::find($id);
            return view('admin.marcas.editar')->with('marca', $marca);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function SalvarEditar(Request $request, $id){
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
                $upload = $request->id_imagem->storeAs('marcas', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'marcas']);
            $imagem->save();

            $dados['id_imagem'] = $imagem->id;       
        }else
            $dados['id_imagem'] = null;


        $info = Marcas::find($id);
        Marcas::where('id', $id)->update([
                            'nome' => $dados['nome'],
                            'status' => (isset($dados['status']) ? 1 : 0), 
                            'descricao' => $dados['descricao'],
                            'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : $info->id_imagem),                         
                        ]);

        Atividades::create([
            'nome' => 'Edição de uma marca',
            'descricao' => 'Você alterou algumas informações da marca '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.marcas', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
        
        return redirect(route('exibir.marcas'));
    }

    // Alterando status da marca
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1){
            $marcas = Marcas::find($id);
            if($marcas->status == 1){
                Marcas::where('id', $id)->update(['status' => 0, 'mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou uma marca',
                    'descricao' => 'Você desabilitou a marca '.$marcas->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.marcas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Marcas::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou uma marca',
                    'descricao' => 'Você habilitou a marca '.$marcas->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.marcas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }  
    }

    // Mostrar na home a marca
    public function Home($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1){
            $marcas = Marcas::find($id);
            if($marcas->mostrar_na_home == 1){
                Marcas::where('id', $id)->update(['mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Removeu da home uma marca',
                    'descricao' => 'Você removeu da página principal a marca '.$marcas->nome.".",
                    'icone' => 'mdi-home-remove',
                    'url' => route('editar.marcas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Marcas::where('id', $id)->update(['mostrar_na_home' => 1, 'status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou na home uma marca',
                    'descricao' => 'Você habilitou na página principal a marca '.$marcas->nome.".",
                    'icone' => 'mdi-home-plus',
                    'url' => route('editar.marcas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }  
    }
}