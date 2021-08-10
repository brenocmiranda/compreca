<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\CategoriasRqt;
use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Imagens;
use App\Models\Atividades;

class CategoriasCtrl extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista categoria
    public function Exibir(){
        
        if(Auth::guard('admin')->user()->RelationGrupo->ver_categorias == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1){
            $categorias = (Auth::guard('admin')->user()->id_loja != null ? Categorias::where('id_loja', Auth::guard('admin')->user()->id_loja)->count() : Categorias::all()->count());
            return view('admin.categorias.lista')->with('categorias', $categorias);
        }else{
            return redirect(route('permission'));
        }
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Categorias::all())
                    ->editColumn('imagem', function(Categorias $dados){ 
                        return '<div class="m-auto"><img src="'.( isset($dados->RelationImagens->caminho) ? asset('storage/app/'.$dados->RelationImagens->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 45px; width: 45px;" class="rounded" ></div><div class="text-left my-auto"></div>';
                    })
                    ->editColumn('categoria', function(Categorias $dados){ 
                        return '<h6 class="text-decoration-none mb-0"><b>'.$dados->nome.'</b></h6>';
                    })
                    ->editColumn('status1', function(Categorias $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Categorias $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.categorias', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar categoria
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.categorias', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar categoria
                                </a> 
                            </div>');
                    })->rawColumns(['imagem', 'categoria', 'status1', 'acoes'])->make(true);
        }else{
            return datatables()->of(Categorias::where('id_loja', Auth::guard('admin')->user()->id_loja)->get())
                    ->editColumn('imagem', function(Categorias $dados){ 
                        return '<div class="m-auto"><img src="'.( isset($dados->RelationImagens->caminho) ? asset('storage/app/'.$dados->RelationImagens->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 45px; width: 45px;" class="rounded" ></div><div class="text-left my-auto"></div>';
                    })
                    ->editColumn('categoria', function(Categorias $dados){ 
                        return '<h6 class="text-decoration-none mb-0"><b>'.$dados->nome.'</b></h6>';
                    })
                    ->editColumn('status1', function(Categorias $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Categorias $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.categorias', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar categoria
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.categorias', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar categoria
                                </a> 
                            </div>');
                    })->rawColumns(['imagem', 'categoria', 'status1', 'acoes'])->make(true);
        }
    }
    
    // Salvando categoria
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1){
            $categorias = Categorias::all();
            return view('admin.categorias.adicionar')->with('categorias', $categorias);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarAdicionar(CategoriasRqt $request){
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
                $upload = $request->id_imagem->storeAs('categorias', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'categorias']);
            $dados['id_imagem'] = $imagem->id;       
        }

        $categoria = Categorias::create([  
            'nome' => $dados['nome'],
            'status' => (isset($dados['status']) ? 1 : 0), 
            'descricao' => (isset($dados['descricao']) ? $dados['descricao'] :  NULL),
            'id_imagem' => $dados['id_imagem'],
            'id_loja' => Auth::guard('admin')->user()->id_loja,  
        ]);

        Atividades::create([
            'nome' => 'Inserção de nova categoria',
            'descricao' => 'Você cadastrou uma nova categoria, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.categorias', $categoria->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        if($request->acao == "modal"){
            $categoria = Categorias::where('status', 1)->get();
            return $categoria;
        }else{
            return redirect(route('exibir.categorias'));
        }	 
    }

    // Editando categoria
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1){
            $categoria = Categorias::find($id);
            return view('admin.categorias.editar')->with('categoria', $categoria);
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
                $upload = $request->id_imagem->storeAs('categorias', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'categorias']);
            $imagem->save();

            $dados['id_imagem'] = $imagem->id;       
        }else
            $dados['id_imagem'] = null;

        $info = Categorias::find($id);
        Categorias::where('id', $id)->update([
                        'nome' => $dados['nome'],
                        'status' => (isset($dados['status']) ? 1 : 0), 
                        'descricao' => (isset($dados['descricao']) ? $dados['descricao'] :  NULL),
                        'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : $info->id_imagem),                          
                    ]);  

        Atividades::create([
            'nome' => 'Edição de uma categoria',
            'descricao' => 'Você alterou algumas informações da categoria '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.categorias', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.categorias'));
    }

    // Alterando status categoria
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1){
            $categoria = Categorias::find($id);
            if($categoria->status == 1){
                Categorias::where('id', $id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou uma categoria',
                    'descricao' => 'Você desabilitou a categoria '.$categoria->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.categorias', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Categorias::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou uma categoria',
                    'descricao' => 'Você habilitou a categoria '.$categoria->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.categorias', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }
    }


    // Detalhes da categoria
    public function Detalhes($id){
        $categoria = Categorias::find($id);
        return response()->json($categoria);
    }
}