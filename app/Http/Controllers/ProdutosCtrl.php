<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProdutosRqt;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\ProdutosImagens;
use App\Models\ProdutosCategorias;
use App\Models\ProdutosVariacoes;
use App\Models\Categorias;
use App\Models\Variacoes;
use App\Models\VariacoesOpcoes;
use App\Models\Marcas;
use App\Models\Imagens;
use App\Models\Atividades;

class ProdutosCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    // Listando produtos
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_produtos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1){
            $produtos = (Auth::guard('admin')->user()->id_loja != null ? Produtos::where('id_loja', Auth::guard('admin')->user()->id_loja)->count() : Produtos::all()->count());
            return view('admin.produtos.lista')->with('produtos', $produtos);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
            return datatables()->of(Produtos::all())
                    ->editColumn('produto1', function(Produtos $dados){ 
                    return '<div class="d-flex my-2"><div class="my-auto col-3 px-3"><img src="'.(isset($dados->RelationImagensPrincipal) ? asset('storage/app/'.$dados->RelationImagensPrincipal->first()->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 55px; width: 55px;" class="rounded" ></div><div class="text-left my-auto"><h6 class="text-decoration-none "><b>'.substr($dados->nome, 0, 60).'</b></h6><label class="mb-0">'.$dados->cod_sku.'</label></div></div>';
                    })
                    ->editColumn('valor', function(Produtos $dados){
                        return ($dados->preco_promocional!=0 ? 'R$ '.number_format($dados->preco_promocional, 2, ',', '.').'<br><small class="text-danger" style="text-decoration: line-through">R$'.number_format($dados->preco_venda, 2, ',', '.').'</small>' : number_format($dados->preco_venda, 2, ',', '.'));
                    })
                    ->editColumn('status1', function(Produtos $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Produtos $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.produtos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar produto
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.produtos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar produto
                                </a> 
                            </div>');
                    })->rawColumns(['produto1', 'valor', 'status1', 'acoes'])->make(true);
        }else{
            return datatables()->of(Produtos::where('id_loja', Auth::guard('admin')->user()->id_loja)->get())
                    ->editColumn('produto1', function(Produtos $dados){ 
                    return '<div class="d-flex my-2"><div class="my-auto col-3 px-3"><img src="'. (isset($dados->RelationImagensPrincipal) ? asset('storage/app/'.$dados->RelationImagensPrincipal->first()->caminho) : asset('public/admin/img/system/product.png')).'" alt="Imagem atual" style="height: 55px; width: 55px;" class="rounded" ></div><div class="text-left my-auto"><h6 class="text-decoration-none "><b>'.substr($dados->nome, 0, 60).'</b></h6><label class="mb-0">'.$dados->cod_sku.'</label></div></div>';
                    })
                    ->editColumn('valor', function(Produtos $dados){
                        return 'R$ '. ($dados->preco_promocional!=0 ? '<del class="text-secondary">'.number_format($dados->preco_venda, 2, ',', '.').'</del><br> R$ '.number_format($dados->preco_promocional, 2, ',', '.')  : number_format($dados->preco_venda, 2, ',', '.'));
                    })
                    ->editColumn('status1', function(Produtos $dados){
                        return '<div class="text-'.($dados->status==1 ? 'success' : 'danger').'"><i class="fas fa-circle"></i></div>';
                    })
                    ->editColumn('acoes', function(Produtos $dados){ 
                        return ($dados->status == 1 ? '
                            <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.produtos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-close"></i> Desativar produto
                                </a> 
                            </div>'
                            : 
                            '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('editar.produtos', $dados->id).'">
                                    <i class="mdi mdi-pencil"></i> Editar informações
                                </a> 
                                <a class="status dropdown-item has-icon" href="javascript:void(0)" onClick="alterarStatus('.$dados->id.')">
                                    <i class="mdi mdi-check"></i> Ativar produto
                                </a> 
                            </div>');
                    })->rawColumns(['produto1', 'valor', 'status1', 'acoes'])->make(true);
        }
    }

    // Adicionando produto
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1){
            $marcas = Marcas::where('status', 1)->get();
            $categorias = Categorias::where('status', 1)->get();
            $variacoes = Variacoes::where('status', 1)->get();
            $opcoes = VariacoesOpcoes::all();
            return view('admin.produtos.adicionar')->with('categorias', $categorias)->with('marcas', $marcas)->with('variacoes', $variacoes)->with('opcoes', $opcoes);
        }else{
            return redirect(route('permission'));
        }  
    }
    public function SalvarAdicionar(ProdutosRqt $request){
        $dados = $request->except('_token');

        // Inserindo o produto
        $produto = Produtos::create([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'variante' => ($dados['variante'] == 'true' ? 1 : 0), 
            'tipo' => $dados['tipo'],
            'nome' => $dados['nome'],
            'cod_sku' => $dados['cod_sku'],
            'cod_ean' => $dados['cod_ean'],
            'disponivel_venda' => (isset($dados['disponivel_venda']) ? 1 : 1), 
            'preco_custo' => (isset($dados['preco_custo']) ? str_replace(",", ".", str_replace(".", "",$dados['preco_custo'])) : 0),
            'preco_venda' => str_replace(",", ".", str_replace(".", "",$dados['preco_venda'])),
            'preco_promocional' =>  (isset($dados['preco_promocional']) ? str_replace(",", ".", str_replace(".", "",$dados['preco_promocional'])) : 0),
            'peso' => $dados['peso'],
            'largura' => $dados['largura'],
            'altura' => $dados['altura'],
            'comprimento' => $dados['comprimento'],
            'quantidade' => $dados['quantidade'],
            'descricao' => $dados['descricao'],
            'id_marca' => $dados['id_marca'],
            'id_usuario' => Auth::guard('admin')->id(),
            'id_loja' => Auth::guard('admin')->user()->id_loja                        
        ]);
        // Cadastramento da imagem principal
        if(isset($request->imagem_principal)){
            $nameFile = null;
            if ($request->hasFile('imagem_principal') && $request->file('imagem_principal')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension =  $request->imagem_principal->extension();
                $nameFile = "{$name}.{$extension}";
                $upload =  $request->imagem_principal->storeAs('produtos', $nameFile);
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'produtos_principal']);
            $imagem_produto = ProdutosImagens::create([
                    'id_imagem' => $imagem->id, 
                    'id_produto' => $produto->id
                ]);
        }
        // Cadastramento de várias imagens do mesmo produto
        if ($request->imagens) {
            foreach($request->imagens as $img){
                $imagem_produto = ProdutosImagens::create([
                    'id_imagem' => $img, 
                    'id_produto' => $produto->id
                ]);
            }
        }
        // Cadastramento das categorias
        if($request->categorias){
            foreach($request->categorias as $categorias){                
                ProdutosCategorias::create([
                    'id_categoria' => $categorias, 
                    'id_produto' => $produto->id
                ]);
            }
        }

        // Cadastramento das variacões
        if($request->variacoes){
            foreach($request->variacoes as $variacoes){                
                ProdutosVariacoes::create([
                    'id_variacao' => $variacoes, 
                    'id_produto' => $produto->id
                ]);
            }
        }

        Atividades::create([
            'nome' => 'Inserção de novo produto',
            'descricao' => 'Você cadastrou uma novo produto, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.produtos', $produto->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.produtos'));
    }

    // Editando produto
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1){
    		$produto = Produtos::find($id);
            $marcas = Marcas::where('status', 1)->get();
            $opcoes = VariacoesOpcoes::all();
            
            // Retirando categorias que já estão relacionadas
            $categorias = Categorias::where('status', 1)->get();
            $categorias1 = ProdutosCategorias::where('id_produto', $id)->get();        
            foreach ($categorias as $key => $categoria) {
                foreach ($categorias1 as $key1 => $categoria1) {
                    if($categoria1->id_categoria == $categoria->id){
                        unset($categorias[$key]);
                    }
                }
            }
            // Retirando variações que já estão relacionadas
            $variacoes = Variacoes::where('status', 1)->get();
            $variacoes1 = ProdutosVariacoes::where('id_produto', $id)->get(); 
            foreach ($variacoes as $key => $variacao) {
                foreach ($variacoes1 as $key1 => $variacao1) {
                    if($variacao1->id_variacao == $variacao->id){
                        unset($variacoes[$key]);
                    }
                }
            }
        	return view('admin.produtos.editar')->with('produto', $produto)->with('categorias', $categorias)->with('marcas', $marcas)->with('variacoes', $variacoes)->with('opcoes', $opcoes);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->except('_token');
        Produtos::where('id', $id)->update([
                           'status' => (isset($dados['status']) ? 1 : 0), 
                            'variante' => ($dados['variante'] == 'true' ? 1 : 0), 
                            'tipo' => $dados['tipo'],
                            'nome' => $dados['nome'],
                            'cod_sku' => $dados['cod_sku'],
                            'cod_ean' => $dados['cod_ean'],
                            'preco_custo' => (isset($dados['preco_custo']) ? str_replace(",", ".", str_replace(".", "",$dados['preco_custo'])) : 0),
                            'preco_venda' => str_replace(",", ".", str_replace(".", "",$dados['preco_venda'])),
                            'preco_promocional' =>  (isset($dados['preco_promocional']) ? str_replace(",", ".", str_replace(".", "",$dados['preco_promocional'])) : 0),
                            'peso' => $dados['peso'],
                            'largura' => $dados['largura'],
                            'altura' => $dados['altura'],
                            'comprimento' => $dados['comprimento'],
                            'quantidade' => $dados['quantidade'],
                            'descricao' => $dados['descricao'],
                            'id_marca' => $dados['id_marca'],
                            'id_usuario' => Auth::guard('admin')->id(),
                            'id_loja' => Auth::guard('admin')->user()->id_loja                         
                        ]);

        // Cadastramento da imagem principal
        if(isset($request->imagem_principal)){
            if($request->imagem_principal_id){
                $imagem = Imagens::find($request->imagem_principal_id);
                unlink(getcwd().'/storage/app/'.$imagem->caminho);
                ProdutosImagens::join('imagens', 'imagens.id', 'id_imagem')->where('id_produto', $id)->where('tipo', 'produtos_principal')->delete();
                Imagens::find($imagem->id)->delete(); 
            } 

            $nameFile = null;
            if ($request->hasFile('imagem_principal') && $request->file('imagem_principal')->isValid()) {
                $name = uniqid(date('HisYmd'));
                $extension =  $request->imagem_principal->extension();
                $nameFile = "{$name}.{$extension}";
                $upload =  $request->imagem_principal->storeAs('produtos', $nameFile);
            } 

            $image = Imagens::create(['caminho' => $upload, 'tipo' => 'produtos_principal']);
            $imagem_produto = ProdutosImagens::create([
                    'id_imagem' => $image->id, 
                    'id_produto' => $id
                ]);
        }

        // Cadastramento de várias imagens do mesmo produto
        if ($request->imagens) {
            $dados = ProdutosImagens::join('imagens', 'imagens.id', 'id_imagem')->where('id_produto', $id)->where('tipo', '<>', 'produtos_principal')->delete();
            foreach($request->imagens as $img){
                $imagem_produto = ProdutosImagens::create([
                    'id_imagem' => $img, 
                    'id_produto' => $id
                ]);
            }
        }else{
            ProdutosImagens::join('imagens', 'imagens.id', 'id_imagem')->where('id_produto', $id)->where('tipo', '<>', 'produtos_principal')->delete();
        }

        // Cadastramento das categorias
        if($request->categorias){
            ProdutosCategorias::where('id_produto', $id)->delete();
            foreach($request->categorias as $categorias){                
                ProdutosCategorias::create([
                    'id_categoria' => $categorias, 
                    'id_produto' => $id
                ]);
            }
        }else{
            ProdutosCategorias::where('id_produto', $id)->delete();
        }

        // Cadastramento das variacões
        if($request->variacoes){
            ProdutosVariacoes::where('id_produto', $id)->delete();
            foreach($request->variacoes as $variacoes){                
                ProdutosVariacoes::create([
                    'id_variacao' => $variacoes, 
                    'id_produto' => $id
                ]);
            }
        }else{
            ProdutosVariacoes::where('id_produto', $id)->delete();
        }
        
        Atividades::create([
            'nome' => 'Edição de um produto',
            'descricao' => 'Você alterou algumas informações do produto '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.produtos', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        return redirect(route('exibir.produtos'));
    }

    // Alterando status produtos
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1){
            $produtos = Produtos::find($id);
            if($produtos->status == 1){
                Produtos::where('id', $id)->update(['status' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou um produto',
                    'descricao' => 'Você desabilitou o produto '.$produtos->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.produtos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Produtos::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou um produto',
                    'descricao' => 'Você habilitou o produto '.$produtos->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.produtos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            return response()->json(['success' => true]);
        }else{
            return redirect(route('permission'));
        }  
    }

    // Importando fotos do produtos
    public function Imagens(Request $request){
        // Cadastramento de várias imagens do mesmo produto
        if ($request->hasFile('imagens')) {
            foreach($request->file('imagens') as $imagem){
                if ($imagem->isValid()){
                    $name = uniqid(date('HisYmd'));
                    $extension =  $imagem->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload =  $imagem->storeAs('produtos', $nameFile);
                }
                
                $imagens[] = Imagens::create(['caminho' => $upload, 'tipo' => 'produtos']);
            }
        }
        return response()->json($imagens);
    }

    // Importando fotos do produtos
    public function RemoveImagens($id){
        $imagem = Imagens::find($id);
        unlink(getcwd().'/storage/app/'.$imagem->caminho);
        ProdutosImagens::where('id_imagem', $id)->delete();
        Imagens::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    
}
