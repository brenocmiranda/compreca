<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Notifications\CadastroCliente;
use App\Http\Requests\LoginRqt;
use App\Http\Requests\ClientesRqt;
use App\Models\Leads;
use App\Models\Clientes;
use App\Models\Telefones;
use App\Models\Enderecos;
use App\Models\Favoritos;
use App\Models\Produtos;
use App\Models\Categorias;
use App\Models\Marcas;
use App\Models\Lojas;
use App\Models\Instituicoes;
use App\Models\PagFooter;
use App\Models\PagMenu;
use App\Models\PagNavbar;
use App\Models\PagSections;
use App\Models\PagSectionsCard;
use App\Models\PagSlider;

class PaginaInicialCtrl extends Controller
{

	public function __construct(){
        $this->navbar = PagNavbar::find(1);
        $this->menu = PagMenu::where('status', 1)->orderBy('nome', 'ASC')->get();
        $this->slider = PagSlider::where('status', 1)->get();
        $this->sections = PagSections::where('status', 1)->get();
        $this->cards = PagSectionsCard::where('status', 1)->get();
        $this->categorias = Categorias::where('status', 1)->orderBy('nome', 'ASC')->get();
    }

    /*-----------------------------------------------------*/
    /*              Área interna (Clientes)                */
    /*-----------------------------------------------------*/
    // Pedidos
    public function Pedidos(){
        if(Auth::check()){
            return view('cliente.me.pedidos')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        }else{
             return redirect(route('login.mkt'));
        } 
    }

    // Minha conta
    public function Perfil(){
        if(Auth::check()){
            return view('cliente.me.perfil')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        }else{
            return redirect(route('login.mkt'));
        }  
    }
    public function SalvarPerfil(ClientesRqt $request, $id){
        $dados = Clientes::find($id);
        Clientes::find($id)->update([
            'email' => $request->email,
            'password' => (isset($request->password) ? Hash::make($request->password) : $dados->password),
            'tipo' => $request->tipo,
            'documento' => $request->documento,
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'data_nascimento' => (isset($request->data_nascimento) ? $request->data_nascimento : null),
            'sexo' => $request->sexo,
            '_token' => $request->_token
        ]);
       Telefones::where('id_cliente', $id)->update([
            'nome' => "Telefone principal",
            'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $request->telefone))),
            'tel_whatsapp' => (isset($request->whatsapp) ? str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $request->telefone))) : null),
            'id_cliente' => $id
        ]);  

        \Session::flash('confirm', array(
            'class' => 'success',
            'mensagem' => 'Seus dados foram alterados com sucesso!'
        ));

        return redirect(route('perfil.mkt'));
    }
    
    // Endereços
    public function Enderecos(){
        if(Auth::check()){
            return view('cliente.me.enderecos')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        }else{
            return redirect(route('login.mkt'));
        } 
    }
    public function AdicionarEnderecos(Request $request){
        $enderecos = Enderecos::create([
            'nome' => $request->nomeOutro,
            'outros' => ($request->nome == 1 ? 1 : 0),
            'status' => 1,
            'destinatario' => $request->destinatario,
            'cep' => str_replace("-", "", $request->cep),
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'complemento' => (isset($request->complemento) ? $request->complemento : null),
            'referencia' => (isset($request->referencia) ? $request->referencia : null),
            'bairro' => (isset($request->bairro) ? $request->bairro : $request->bairro1),
            'cidade' => (isset($request->cidade) ? $request->cidade : $request->cidade1),
            'estado' => (isset($request->estado) ? $request->estado : $request->estado1),
            'id_cliente' => Auth::id()
        ]); 
        return redirect(route('enderecos.mkt'));
    }
    public function EditarEnderecos(Request $request){
        $enderecos = Enderecos::find($request->id)->update([
            'nome' => $request->nomeOutro,
            'outros' => ($request->nome == 1 ? 1 : 0),
            'destinatario' => $request->destinatario,
            'cep' => str_replace("-", "", $request->cep),
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'complemento' => (isset($request->complemento) ? $request->complemento : null),
            'referencia' => (isset($request->referencia) ? $request->referencia : null),
            'bairro' => (isset($request->bairro) ? $request->bairro : $request->bairro1),
            'cidade' => (isset($request->cidade) ? $request->cidade : $request->cidade1),
            'estado' => (isset($request->estado) ? $request->estado : $request->estado1),
            'id_cliente' => Auth::id()
        ]); 
        return redirect(route('enderecos.mkt'));
    }
    public function RemoverEnderecos($id){
        Enderecos::find($id)->delete();
        return response()->json(['success' => true]);
    }
    public function AlterarEnderecos($id){
        Enderecos::where('id_cliente', Auth::id())->update(['status' => 0]); 
        Enderecos::find($id)->update(['status' => 1]); 
        return response()->json(['success' => true]);
    }
    public function DetalhesEnderecos($id){
        $endereco = Enderecos::find($id); 
        return $endereco;
    }

    // Favoritos
    public function Favoritos(){
        if(Auth::check()){
            return view('cliente.me.favoritos')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        }else{
            return redirect(route('login.mkt'));
        }   
    }
    public function AdicionarFavoritos(Request $request){
        $favoritos = Favoritos::create([
            'id_cliente' => Auth::id(),
            'id_produto' => $request->id_produto,
        ]);
        return response()->json(['success' => true]);
    }
    public function RemoverFavoritos($id){
        Favoritos::find($id)->delete();
        return response()->json(['success' => true]);
    }



    // Avaliações
    public function Avaliacoes(){
        if(Auth::check()){
            return view('cliente.me.avaliacoes')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        }else{
            return redirect(route('login.mkt'));
        }   
    }

    // Dúvidas
    public function Duvidas(){
        return view('cliente.me.duvidas')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }


    /*-----------------------------------------------------*/
    /*              Área externa (Clientes)                */
    /*-----------------------------------------------------*/  
    // Página inicial
    public function Home(){
        return view('cliente.system.home')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('slider', $this->slider)->with('sections', $this->sections)->with('cards', $this->cards)->with('categorias', $this->categorias);
    }

    // Login
    public function Login(){
        if(Auth::check()){
            return redirect(route('pedidos.mkt'));
        }else{
            return view('cliente.system.login')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        } 
    }
    public function processLogin(LoginRqt $FormLogin){
        Auth::guard('web')->logoutOtherDevices($FormLogin->password);

        if (Auth::guard('web')->attempt(['email' => $FormLogin->email, 'password' => $FormLogin->password, 'status' => 1], $FormLogin->remember)){
           return redirect()->intended();  

        // Não ativo
        }elseif(Clientes::where('email', $FormLogin->email)->where('status', 0)->first()){
            \Session::flash('login', array(
                'class' => 'danger',
                'mensagem' => 'O usuário encontra-se desativado.'
            ));
            return redirect(route('login.mkt'));

        // Senha não confere
        }elseif(Clientes::where('email', $FormLogin->email)->first()){
            \Session::flash('login', array(
                'class' => 'danger',
                'mensagem' => 'A senha inserida não confere.'
            ));
            return redirect(route('login.mkt'));
            
        // E-mail não confere
        }else{
            \Session::flash('login', array(
                'class' => 'danger',
                'mensagem' => 'E-mail não cadastrado.'
            ));
            return redirect(route('login.mkt'));
        }   
    }

    // Logout
    public function Logout(){
        Auth::guard('web')->logout();
        return redirect(route('home.mkt'));
    }

    // Cadastro 
    public function Cadastro(){
        return view('cliente.system.cadastro')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
        
    }
    public function SalvarCadastro(ClientesRqt $request){
        $user = Clientes::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'documento' => $request->documento,
            'nome' => $request->nome,
            'data_nascimento' => (isset($request->data_nascimento) ? $request->data_nascimento : null),
            'sexo' => $request->sexo,
            '_token' => $request->_token
        ]);
        $telefone = Telefones::create([
            'nome' => "Telefone principal",
            'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $request->telefone))),
            'tel_whatsapp' => (isset($request->whatsapp) ? str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $request->telefone))) : null),
            'id_cliente' => $user->id
        ]);

        if(isset($request->leads)){
            $lead = Leads::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'tel_contato' => str_replace("(", "+55", str_replace(") ", "", str_replace("-", "", $request->telefone))),
            ]);
        }

        $user->notify(new CadastroCliente($user));
        Auth::loginUsingId($user->id);
        return redirect(route('login.mkt'));
    }
    public function AtivarCadastro($token){
        $active = Clientes::where('_token', $token)->whereNull('email_verified_at')->first();
        if(isset($active)){
            Clientes::where('_token', $token)->update(['email_verified_at' => now()]);

            \Session::flash('confirm', array(
                    'class' => 'success',
                    'mensagem' => 'Seus dados foram confirmados! Muito obrigado :)'
                ));
            return redirect(route('pedidos.mkt'));
        }else{
            return redirect(route('login.mkt'));
        }
    }

    // Funções de validação de E-mail e CPF
    public function ValidaEmail($email){
        $emails = Clientes::where('email', $email)->get();
        if(isset($emails[0])){
            return response()->json(['valid' => true]);
        }else{
            return response()->json(['valid' => false]);
        }
    }
    public function ValidaDocumento($documento){
        $doc = Clientes::where('documento', $documento)->get();
        if(isset($doc[0])){
            return response()->json(['valid' => true]);
        }else{
            return response()->json(['valid' => false]);
        }
    }

    // Carrinho de compras
    public function Carrinho(){
        return view('cliente.system.carrinho')->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }

    // Retornando produtos da pesquisa
    public function Search(Request $request){
        $dados = Produtos::where('nome', 'like', '%'.$request->pesquisa.'%')->orWhere('cod_sku','like','%'.$request->pesquisa.'%')->orWhere('descricao','like','%'.$request->pesquisa.'%')->where('status', 1)->orderBy('nome')->get();
        return view('cliente.system.search')->with('dados', $dados)->with('pesquisa', $request->pesquisa)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }   

    // Detalhes do poduto
    public function ProdutosDetalhes($cod_sku){
        $produto = Produtos::where('cod_sku', $cod_sku)->first();
        return view('cliente.produtos.detalhes')->with('produto', $produto)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }

    // LOJAS
    public function Lojas(){
        $dados = Lojas::where('status', 1)->get();
        return view('cliente.lojas.listar')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }
    public function LojasDetalhes($id){
        $dados = Lojas::where('status', 1)->find($id);
        return view('cliente.lojas.detalhes')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }


    // MARCAS
    public function Marcas(){
        $dados = Marcas::where('status', 1)->get();
        return view('cliente.marcas.listar')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }
    public function MarcasDetalhes($id){
        $dados = Marcas::where('status', 1)->find($id);
        return view('cliente.marcas.detalhes')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }


    // INSTITUIÇÕES
    public function Instituicoes(){
        $dados = Instituicoes::where('status', 1)->get();
        return view('cliente.instituicoes.listar')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }
    public function InstituicoesDetalhes($id){
        $dados = Instituicoes::where('status', 1)->find($id);
        return view('cliente.instituicoes.detalhes')->with('dados', $dados)->with('navbar', $this->navbar)->with('menu', $this->menu)->with('categorias', $this->categorias);
    }
}
