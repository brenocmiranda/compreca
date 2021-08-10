<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\LojasRqt;
use Illuminate\Http\Request;
use App\Models\Lojas;
use App\Models\Categorias;
use App\Models\Instituicoes;
use App\Models\Imagens;
use App\Models\Atividades;

class LojasCtrl extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista loja
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1){
            $lojas = Lojas::orderBy('status', 'desc')->get();
            return view('admin.lojas.lista')->with('lojas', $lojas);
        }else{
            return redirect(route('permission'));
        }
    }

    // Adicionando a loja
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1){
            $lojas = Lojas::all();
            $categorias = Categorias::where('status', 1)->get();
            $instituicoes = Instituicoes::where('status', 1)->get();
            return view('admin.lojas.adicionar')->with('lojas', $lojas)->with('categorias', $categorias)->with('instituicoes', $instituicoes);
        }else{
            return redirect(route('permission'));
        }
    }
    public function SalvarAdicionar(LojasRqt $request){
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

        $lojas = Lojas::create([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'razao_social' => $dados['razao_social'],
            'documento' => $dados['documento'],
            'id_instituicao' => $dados['id_instituicao'], 
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
            'id_logomarca' => $dados['id_logomarca'], 
            'id_imagem' => (isset($dados['id_imagem']) ? $dados['id_imagem'] : null),                        
        ]);

        Atividades::create([
            'nome' => 'Inserção de nova loja',
            'descricao' => 'Você cadastrou uma nova loja, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.lojas', $lojas->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        if($request->acao == "modal"){
            return $lojas;
        }else{
            return redirect(route('exibir.lojas'));
        }
    }

    // Editando a loja
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1){
            $lojas = Lojas::find($id);
            $categorias = Categorias::where('status', 1)->get();
            $instituicoes = Instituicoes::where('status', 1)->get();
            return view('admin.lojas.editar')->with('lojas', $lojas)->with('categorias', $categorias)->with('instituicoes', $instituicoes);
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

        $info = Lojas::find($id);
        $lojas = Lojas::where('id', $id)->update([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'razao_social' => $dados['razao_social'],
            'documento' => $dados['documento'],
            'id_instituicao' => $dados['id_instituicao'], 
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
            'nome' => 'Edição de uma loja',
            'descricao' => 'Você alterou algumas informações da loja '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.lojas', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
        
        return redirect(route('exibir.lojas'));
    }

    // Alterando status da loja
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1){
            $loja = Lojas::find($id);
            if($loja->status == 1){
                Lojas::where('id', $id)->update(['status' => 0, 'mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou uma loja',
                    'descricao' => 'Você desabilitou a loja '.$loja->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.lojas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Lojas::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou uma loja',
                    'descricao' => 'Você habilitou a loja '.$loja->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.lojas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            $loja = Lojas::select('status', 'mostrar_na_home')->find($id);
            return $loja;
        }else{
            return redirect(route('permission'));
        }
    }

    // Mostrar na home a loja
    public function Home($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1){
            $loja = Lojas::find($id);
            if($loja->mostrar_na_home == 1){
                Lojas::where('id', $id)->update(['mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Removeu da home uma loja',
                    'descricao' => 'Você removeu da página principal a loja '.$loja->nome.".",
                    'icone' => 'mdi-home-remove',
                    'url' => route('editar.lojas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Lojas::where('id', $id)->update(['mostrar_na_home' => 1, 'status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou na home uma loja',
                    'descricao' => 'Você habilitou na página principal a loja '.$loja->nome.".",
                    'icone' => 'mdi-home-plus',
                    'url' => route('editar.lojas', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            $loja = Lojas::select('status', 'mostrar_na_home')->find($id);
            return $loja;
        }else{
            return redirect(route('permission'));
        }
    }
}

