<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\InstituicoesRqt;
use Illuminate\Http\Request;
use App\Models\Instituicoes;
use App\Models\Imagens;
use App\Models\Atividades;

class InstituicoesCtrl extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista instituição
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_instituicoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1){
            $instituicoes = Instituicoes::orderBy('status', 'desc')->get();
            return view('admin.instituicoes.lista')->with('instituicoes', $instituicoes);
        }else{
            return redirect(route('permission'));
        }    
    }

    // Adicionando a instituição
    public function Adicionar(){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1){
            $instituicoes = Instituicoes::all();
            return view('admin.instituicoes.adicionar')->with('instituicoes', $instituicoes);
        }else{
            return redirect(route('permission'));
        }	
    }
    public function SalvarAdicionar(InstituicoesRqt $request){
        $dados = $request->except(['_token', 'acao']);

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
                $upload = $request->id_logomarca->storeAs('instituicoes', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/instituicoes/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'instituicoes']);
            $dados['id_logomarca'] = $imagem->id;       
        }

        $instituicoes = Instituicoes::create([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'razao_social' => $dados['razao_social'],
            'documento' => $dados['documento'],
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
            'id_logomarca' => $dados['id_logomarca'],                        
        ]);

        Atividades::create([
            'nome' => 'Inserção de nova instituição',
            'descricao' => 'Você cadastrou uma nova instituição, '.$dados['nome'].".",
            'icone' => 'mdi-plus-thick',
            'url' => route('editar.instituicoes', $instituicoes->id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);

        if($request->acao == "modal"){
            return $instituicoes;
        }else{
            return redirect(route('exibir.instituicoes'));
        }
    }

    // Editando a instituição
    public function Editar($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1){
            $instituicoes = Instituicoes::find($id);
            return view('admin.instituicoes.editar')->with('instituicoes', $instituicoes);
        }else{
            return redirect(route('permission'));
        }           
    }
    public function SalvarEditar(Request $request, $id){
        $dados = $request->except('_token');

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
                $upload = $request->id_logomarca->storeAs('instituicoes', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/instituicoes/nomedinamicoarquivo.extensao
            }
                    
            $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'instituicoes']);
            $dados['id_logomarca'] = $imagem->id;       
        }

        $info = Instituicoes::find($id);
        $instituicoes = Instituicoes::where('id', $id)->update([
            'status' => (isset($dados['status']) ? 1 : 0), 
            'nome' => $dados['nome'],
            'razao_social' => $dados['razao_social'],
            'documento' => $dados['documento'],
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
            'id_logomarca' => (isset($dados['id_logomarca']) ? $dados['id_logomarca'] : $info->id_logomarca),           
        ]);

        Atividades::create([
            'nome' => 'Edição de uma instituição',
            'descricao' => 'Você alterou algumas informações da instituição '.$dados['nome'].".",
            'icone' => 'mdi-pencil-outline',
            'url' => route('editar.instituicoes', $id),
            'id_usuario' => Auth::guard('admin')->id()
        ]);
        
        return redirect(route('exibir.instituicoes'));
    }

    // Alterando status da instituição
    public function Status($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1){
            $instituicao = Instituicoes::find($id);
            if($instituicao->status == 1){
                Instituicoes::where('id', $id)->update(['status' => 0, 'mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Desabilitou uma instituição',
                    'descricao' => 'Você desabilitou a instituição '.$instituicao->nome.".",
                    'icone' => 'mdi-close-thick',
                    'url' => route('editar.instituicoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Instituicoes::where('id', $id)->update(['status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou uma instituição',
                    'descricao' => 'Você habilitou a instituição '.$instituicao->nome.".",
                    'icone' => 'mdi-check-bold',
                    'url' => route('editar.instituicoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            $instituicao = Instituicoes::select('status', 'mostrar_na_home')->find($id);
            return $instituicao;
        }else{
            return redirect(route('permission'));
        } 
        
    }


    // Mostrar na home a instituição
    public function Home($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1){
            $instituicao = Instituicoes::find($id);
            if($instituicao->mostrar_na_home == 1){
                Instituicoes::where('id', $id)->update(['mostrar_na_home' => 0]);
                Atividades::create([
                    'nome' => 'Removeu da home uma instituição',
                    'descricao' => 'Você removeu da página principal a instituição '.$instituicao->nome.".",
                    'icone' => 'mdi-home-remove',
                    'url' => route('editar.instituicoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }else{
                Instituicoes::where('id', $id)->update(['mostrar_na_home' => 1, 'status' => 1]);
                Atividades::create([
                    'nome' => 'Habilitou na home uma instituição',
                    'descricao' => 'Você habilitou na página principal a instituição '.$instituicao->nome.".",
                    'icone' => 'mdi-home-plus',
                    'url' => route('editar.instituicoes', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
            }
            $instituicao = Instituicoes::select('status', 'mostrar_na_home')->find($id);
            return $instituicao;
        }else{
            return redirect(route('permission'));
        } 
        
    }
}
