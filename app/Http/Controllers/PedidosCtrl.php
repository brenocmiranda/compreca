<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Pedidos;
use App\Models\Clientes;
use App\Models\Leads;
use App\Models\Telefones;
use App\Models\Enderecos;
use App\Models\FormaPagamentos;
use App\Models\Status;
use App\Models\PedidosStatus;
use App\Models\PedidosNotas;
use App\Models\PedidosRastreios;
use Correios;

class PedidosCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // Listando pedidos
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pedidos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
            $pedidos = Pedidos::join('pedidos_status', 'id_pedido', 'pedidos.id')->count();
            return view('admin.pedidos.lista')->with('pedidos', $pedidos);
        }else{
            return redirect(route('permission'));
        } 
    }
    public function Lista(){
        return datatables()->of(Pedidos::join('pedidos_status', 'id_pedido', 'pedidos.id')->select('pedidos.*')->get())
                    ->editColumn('transacao', function(Pedidos $dados){ 
                        return '<div>'.($dados->RelationFormasPagamento->cod == 'card_credit' ? '<img data-v-a542e072="" src="http://download.seaicons.com/icons/iconsmind/outline/512/Credit-Card-3-icon.png" width="30" class="uk-float-left icon-payment">' : '<img data-v-a542e072="" src="https://github.bubbstore.com/svg/billet.svg" width="40" class="uk-float-left icon-payment">').'</div>';
                    })->editColumn('cliente', function(Pedidos $dados){ 
                        return '<div class="text-left"><a href="'.route('detalhes.pedidos', $dados->id).'" class="n_pedido text-decoration-none">#'.$dados->num_pedido.'<p class="nome_pedido mb-0 text-capitalize">'.strtolower($dados->RelationClientes->nome).'</p></a></div>';
                    })->editColumn('data', function(Pedidos $dados){ 
                        return '<div>'.date_format($dados->created_at, "d/m/Y H:i:s").'</div><div class="font-weight-bold">'.$dados->created_at->subMinutes(2)->diffForHumans().'</div>';
                    })->editColumn('valor', function(Pedidos $dados){ 
                        return 'R$ '.number_format($dados->valor_total, 2, ',', '.');
                    })->editColumn('status1', function(Pedidos $dados){ 
                        return '<div class="text-uppercase status badge badge-'.(!empty($dados->RelationStatus->last()->RelationDados) ? $dados->RelationStatus->last()->RelationDados->color : '').'">'.(!empty($dados->RelationStatus->last()->RelationDados) ? $dados->RelationStatus->last()->RelationDados->nome : '').'</div>';  
                    })->editColumn('acoes', function(Pedidos $dados){ 
                        return '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('detalhes.pedidos', $dados->id).'">
                                    <i class="mdi mdi-clipboard-text-outline"></i> Mais detalhes
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-map-marker-radius-outline"></i> Rastrear pedido
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-printer"></i> Imprimir pedido
                                </a> 
                            </div>';
                    })->rawColumns(['transacao', 'cliente', 'data', 'status1', 'valor', 'acoes'])->make(true);
    }

    // Detalhes do pedido
    public function Detalhes($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
            $pedido = Pedidos::find($id);
            $status = Status::all();
            if($pedido->id_rastreio){
                $correios = Correios::rastrear($pedido->RelationRastreios->cod_rastreamento);
            }else{
                $correios = null;
            }
            return view('admin.pedidos.detalhes')->with('pedido', $pedido)->with('status', $status)->with('correios', $correios);
        }else{
            return redirect(route('permission'));
        }
    }

    // Funcionalidades
        // Atualizar status
        public function AtualizarStatus(Request $request, $id){
            if(Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
                $status = PedidosStatus::create([
                        'id_pedido' => $id, 
                        'id_status' => $request->id_status, 
                        'observacoes' => $request->observacoes
                    ]);
                Atividades::create([
                    'nome' => 'Atualização de status',
                    'descricao' => 'Você atualizou o status do pedido #'.$id.".",
                    'icone' => 'mdi-sync',
                    'url' => route('detalhes.pedidos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
                return response()->json(['success' => true]);
            }else{
                return redirect(route('permission'));
            }      
        }

        // Atualizar Nota fiscal
        public function AtualizarNota(Request $request, $id){
            if(Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
                // Retorno dos dados do pedido
                $pedido = Pedidos::find($id);
                // Verificações de existencia de nota
                if(isset($pedido->id_nota)){
                    PedidosNotas::where('id', $pedido->id_nota)->update([
                            'numero_nota' => $request->numero_nota, 
                            'data_emissao' => $request->data_emissao, 
                            'numero_serie' => $request->numero_serie, 
                            'chave' => $request->chave, 
                            'url_nota' => $request->url_nota
                        ]);
                    // Alterando status caso solicitado
                    if($request->alterar_status == 'on'){
                        $status = PedidosStatus::create([
                                'id_pedido' => $id, 
                                'id_status' => 5
                            ]);
                    }
                    Atividades::create([
                        'nome' => 'Atualização de dados de nota fiscal',
                        'descricao' => 'Você atualizou os dados da nota fiscal do pedido #'.$id.".",
                        'icone' => 'mdi-note-outline',
                        'url' => route('detalhes.pedidos', $id),
                        'id_usuario' => Auth::guard('admin')->id()
                    ]);
                }else{
                    $nota = PedidosNotas::create([
                            'numero_nota' => $request->numero_nota, 
                            'data_emissao' => $request->data_emissao, 
                            'numero_serie' => $request->numero_serie, 
                            'chave' => $request->chave, 
                            'url_nota' => $request->url_nota
                    ]);
                    Pedidos::find($id)->update(['id_nota' => $nota->id]);

                      // Alterando status caso solicitado
                    if($request->alterar_status == 'on'){
                        $status = PedidosStatus::create([
                                'id_pedido' => $id, 
                                'id_status' => 5
                            ]);
                    }
                    Atividades::create([
                        'nome' => 'Inserção de nota fiscal',
                        'descricao' => 'Você inseriu uma nota fiscal ao pedido #'.$id.".",
                        'icone' => 'mdi-note-plus-outline',
                        'url' => route('detalhes.pedidos', $id),
                        'id_usuario' => Auth::guard('admin')->id()
                    ]);
                }
                return response()->json(['success' => true]);
            }else{
                return redirect(route('permission'));
            }   
        }

        // Atualizar Endereço
        public function AtualizarEndereco(Request $request, $id){
            if(Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
                // Retorno dos dados do pedido
                $pedido = Pedidos::find($id);
                // Atualização do endereço do cliente
                $endereco = Enderecos::where('id', $pedido->id_endereco)->update([
                        'cep' => $request->cep, 
                        'endereco' => $request->endereco, 
                        'numero' => $request->numero, 
                        'complemento' => (isset($request->complemento) ? $request->complemento : null),
                        'bairro' => (isset($request->bairro) ? $request->bairro : $request->bairro1),
                        'cidade' => (isset($request->cidade) ? $request->cidade : $request->cidade1),
                        'estado' => (isset($request->estado) ? $request->estado : $request->estado1),
                        'destinatario' => $request->destinatario, 
                ]);

                Atividades::create([
                    'nome' => 'Atualização de endereço',
                    'descricao' => 'Você alterou as informações de entrega do pedido #'.$id.".",
                    'icone' => 'mdi-truck-outline',
                    'url' => route('detalhes.pedidos', $id),
                    'id_usuario' => Auth::guard('admin')->id()
                ]);
                return response()->json(['success' => true]);
            }else{
                return redirect(route('permission'));
            } 
        }

        // Atualizar Rastreamento
        public function AtualizarRastreamento(Request $request, $id){
            if(Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1){
                // Retorno dos dados do pedido
                $pedido = Pedidos::find($id);
                // Atualização dados de rastreamento
                if($pedido->id_rastreio){
                    PedidosRastreios::where('id', $pedido->id_rastreio)->update([
                        'cod_rastreamento' => $request->cod_rastreamento, 
                        'link_rastreamento' => $request->link_rastreamento,
                        'observacoes' => $request->observacoes,
                    ]);
                    Atividades::create([
                        'nome' => 'Atualização de código de rastreamento',
                        'descricao' => 'Você alterou as informações de rastreamento do pedido #'.$id.".",
                        'icone' => 'mdi-map-marker-radius-outline',
                        'url' => route('detalhes.pedidos', $id),
                        'id_usuario' => Auth::guard('admin')->id()
                    ]);
                }else{
                    $rastreio = PedidosRastreios::create([
                        'cod_rastreamento' => $request->cod_rastreamento, 
                        'link_rastreamento' => $request->link_rastreamento,
                        'observacoes' => $request->observacoes,
                    ]);
                    Pedidos::find($id)->update(['id_rastreio' => $rastreio->id]);
                    Atividades::create([
                        'nome' => 'Inserção de código de rastreino',
                        'descricao' => 'Você inseriu um código de rastreamento ao pedido #'.$id.".",
                        'icone' => 'mdi-map-marker-radius-outline',
                        'url' => route('detalhes.pedidos', $id),
                        'id_usuario' => Auth::guard('admin')->id()
                    ]);
                }
                
                // Alterando status caso solicitado
                if($request->alterar_status){
                        $status = PedidosStatus::create([
                            'id_pedido' => $id, 
                            'id_status' => 7,
                        ]);
                }
                return response()->json(['success' => true]);
            }else{
                return redirect(route('permission'));
            } 
        }

        // Calculo do valo do frete
        public function CalculoFrete($id, $cep){
            // Retorno dos dados do pedido
            $pedido = Pedidos::find($id);
            $dados = [
            'tipo'              => 'sedex, pac', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => '39510000', // Obrigatório
            'cep_origem'        => '89062080', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => $pedido->RelationProduto->peso, // Peso em kilos
            'comprimento'       => $pedido->RelationProduto->comprimento, // Em centímetros
            'altura'            => $pedido->RelationProduto->altura, // Em centímetros
            'largura'           => $pedido->RelationProduto->largura, // Em centímetros
            //'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Náo obrigatórios
            // 'valor_declarado'   => '1', // Náo obrigatórios
            // 'aviso_recebimento' => '1', // Náo obrigatórios
        ];
            return Correios::cep($pedido->RelationEndereco->cep);
        }
    // Funcionalidades

}
