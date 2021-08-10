@extends('admin.layouts.index')

@section('title')
#{{$pedido->num_pedido}}
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">

         <div class="section-header">
            <div class="mx-3">
                <h1>Pedido: #{{$pedido->num_pedido}}</h1> 
                <small class="px-2">realizado em {{ date_format($pedido->created_at, "d/m/Y") }} às {{ date_format($pedido->created_at, "H:i:s") }}</small>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="{{route('exibir.pedidos')}}">Pedidos</a></div>
                    <div class="breadcrumb-item active">Detalhes</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="mb-3 d-flex px-1">
                        <div class="my-auto status badge badge-{{ (!empty($pedido->RelationStatus->last()->RelationDados) ? $pedido->RelationStatus->last()->RelationDados->color : '') }}">{{strtoupper($pedido->RelationStatus->last()->RelationDados->nome)}}
                        </div>
                        <div class="my-auto">
                            <a href="javascript:"data-toggle="modal" data-target="#modal-status" class="f14 ml15 ml-4">Atualizar status</a>
                        </div>
                        <div class="ml-auto">
                            <div class="dropdown">
                              <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><i class="fa fa-print px-1"></i> Imprimir pedido</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-file-alt px-1"></i> Declaração de conteúdo</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-share-square px-1"></i> Exportar para...</a>
                              </div>
                            </div>
                        </div>
                    </div>

                    <!-- DADOS DO PEDIDO -->
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="col-12 p-0">
                                <div class="d-flex">

                                    <div class="col-3 p-4 cliente">
                                        <h1 class="resumo_title">Cliente</h1>
                                        <div class="mt-2">
                                            <label class="text-truncate mb-0 d-block">
                                                <a href="{{route('editar.clientes', $pedido->id_cliente)}}" class="text-decoration-none text-capitalize">{{ strtolower($pedido->RelationClientes->nome) }}</a>
                                            </label>
                                            <label class="d-block mb-0">{{ $pedido->RelationClientes->email }}</label>
                                            <label class="d-block mb-0">
                                                <i class="fab fa-whatsapp text-success"></i>
                                                <a target="_blank" href="https://api.whatsapp.com/send?phone={{$pedido->RelationClientes->RelationTelefones->tel_contato}}" class="text-decoration-none"> {{$pedido->RelationClientes->RelationTelefones->tel_contato}}</a>
                                            </label>
                                            <label class="d-block mb-0">
                                                <b>{{($pedido->RelationClientes->tipo == 'pf' ? 'CPF:' : 'CNPJ:')}}</b> 
                                                <span> {{ $pedido->RelationClientes->documento }} </span>
                                            </label>
                                            <label class="d-block mb-0">
                                                <b>IP da compra:</b>
                                                <span> 10.11.26.1 </span> 
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-3 p-4 pagamento">
                                        <h1 class="resumo_title">Pagamento</h1><br>
                                        <div class="mt-2">
                                            @if($pedido->RelationFormasPagamento->cod == 'card_credit')
                                            <img data-v-a542e072="" src="http://download.seaicons.com/icons/iconsmind/outline/512/Credit-Card-3-icon.png" width="30" class="uk-float-left icon-payment mr-2">
                                            <span class="h-100 mt-auto font-weight-bold" style="font-size: 15px !important;"> ********** 2132</span>
                                            <div>
                                                <p class="mb-0 pt-2"></p>
                                                <h5 class="mb-0 pt-2">R$ {{ number_format($pedido->valor_total, 2, ",", ".") }}</h5> 
                                                <label class="font-weight-bold">em 3x de R$ 73,34</label> 
                                            </div>
                                            @elseif($pedido->RelationFormasPagamento->cod == 'boleto')
                                            <img data-v-a542e072="" src="https://github.bubbstore.com/svg/billet.svg" width="40" class="uk-float-left icon-payment">
                                            <div>
                                                <h4>Boleto bancário</h4>
                                                <a class="d-block" href="{{$pedido->link_boleto}}" target="_blank"><i class="fa fa-eye mr5"></i> Ver boleto</a>
                                                <a class="btn btn-outline-light my-2 p-0 px-4 text-success" href="https://api.whatsapp.com/send?phone={{$pedido->RelationTelefones['numero']}}&amp;text=Aqui está o boleto do produto *{{$pedido->RelationProduto->nome}}*, no valor de R$ {{number_format($pedido->RelationProduto->preco_venda,2, ',', '.') }}%0a%0aVencimento: *{{date('d/m/Y', strtotime($transactions->boleto_expiration_date))}}*%0a%0aCódigo de barras: *{{$transactions->boleto_barcode}}*%0a%0aLink: {{$pedido->link_boleto}}" target="_blank"><i class="fab fa-whatsapp"></i> Enviar no WhatsApp</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-3 p-4 entrega">
                                        <h1 class="resumo_title">Entrega</h1>
                                        <a href="javascript:void(0)" class="entrega_edit" data-toggle="modal" data-target="#modal-endereco">
                                            <i class="mdi mdi-pencil"></i> 
                                            <span> Editar </span>
                                        </a>
                                        <div class="mt-2">
                                            <label class="d-block mb-0">
                                                <b id="destinatario">{{$pedido->RelationEnderecos->destinatario}}</b>
                                            </label>
                                            <label class="d-block mb-0" id="endereco">
                                                {{ $pedido->RelationEnderecos->endereco.', '.$pedido->RelationEnderecos->numero.', '.$pedido->RelationEnderecos->bairro.', '.$pedido->RelationEnderecos->complemento.', '.$pedido->RelationEnderecos->referencia }}
                                            </label>
                                            <label class="d-block mb-0" id="cidade">
                                                {{$pedido->RelationEnderecos->cidade}} / {{$pedido->RelationEnderecos->estado}}
                                            </label>
                                            <label class="d-block mb-0" id="cep">CEP: 
                                                <b>{{$pedido->RelationEnderecos->cep}}</b>
                                            </label>
                                            <br>
                                            <label class="d-block mb-0">*Prazo: 10 dias</label>
                                            <label class="d-block mb-0">*Data prevista: 26/12/2019</label>
                                        </div>
                                    </div>

                                    <div class="col-3 p-4 valor border-right border-top border-bottom">
                                        <h1 class="resumo_title mt-0">Valor total</h1>
                                        <div class="mt-2">
                                            <h3 class="font-weight-bold">R$ {{ number_format($pedido->valor_total, 2, ",", ".") }}</h3>
                                            <div class="mt-4 row col">
                                                <div>
                                                    <p>Produtos: </p>
                                                    <p>Juros: </p>
                                                    <p>Desconto: </p>
                                                    <p>Frete:  </p>
                                                </div>
                                                <div class="px-4">
                                                    <p>R$ {{ number_format($pedido->valor_produtos, 2, ",", ".") }}</p>
                                                    <p>R$ {{ number_format($pedido->valor_juros, 2, ",", ".") }}</p>
                                                    <p class="text-danger"> R$ {{ number_format($pedido->valor_desconto, 2, ",", ".") }} </p>
                                                    <p>R$ {{ number_format($pedido->valor_frete, 2, ",", ".") }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /DADOS DO PEDIDO -->

                    <!-- /TABS-->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="margin-bottom: -7px">
                        <li class="nav-item px-1">
                            <a class="nav-link active" id="resumo-tab" data-toggle="tab" href="#resumo" role="tab" aria-controls="resumo" aria-selected="false">
                               <b> RESUMO </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="transacoes-tab" data-toggle="tab" href="#transacoes" role="tab" aria-controls="transacoes" aria-selected="false">
                                <b> TRANSAÇÕES </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="nota-tab" data-toggle="tab" href="#nota" role="tab" aria-controls="nota" aria-selected="false">
                                <b> NOTA FISCAL </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="rastreamento-tab" data-toggle="tab" href="#rastreamento" role="tab" aria-controls="rastreamento" aria-selected="false">
                                <b> RASTREAMENTO </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">
                                <b> STATUS </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">
                                <b> HISTÓRICO </b>
                            </a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link" id="emails-tab" data-toggle="tab" href="#emails" role="tab" aria-controls="emails" aria-selected="false">
                                <b>E-MAILS</b>
                            </a>
                        </li>
                    </ul>
                        <!-- RESUMO -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="resumo" role="tabpanel" aria-labelledby="resumo-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row text-center">
                                                @if($pedido->RelationStatus->last()->RelationDados->order != 9)
                                                <div class="col-2 lin_resume">
                                                    @if($pedido->RelationStatus->last()->RelationDados->order >= 1 || $pedido->RelationStatus->last()->RelationDados->order >= 2)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Aguardando pagamento</p>
                                                </div>
                                                <div class="col-2 lin_resume">
                                                     @if($pedido->RelationStatus->last()->RelationDados->order >= 3)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Pagamento aprovado</p>
                                                </div>
                                                <div class="col-2 lin_resume">
                                                     @if($pedido->RelationStatus->last()->RelationDados->order >= 4)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Produtos em separação</p>
                                                </div>
                                                <div class="col-2 lin_resume">

                                                     @if($pedido->RelationStatus->last()->RelationDados->order >= 5 || $pedido->RelationStatus->last()->RelationDados->order >= 6)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Faturado</p>
                                                </div>
                                                <div class="col-2 lin_resume">
                                                     @if($pedido->RelationStatus->last()->RelationDados->order >= 7)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Produtos em transporte</p>
                                                </div>
                                                <div class="col-2 lin_resume">
                                                     @if($pedido->RelationStatus->last()->RelationDados->order >= 8)
                                                    <div class="lin_1 progress-status"></div>
                                                    <div class="holder-icon">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @else
                                                    <div class="lin_1"></div>
                                                    <div class="holder-icon-no">
                                                        <i class="icon-check fa fa-check"></i>
                                                    </div>
                                                    @endif
                                                    <p>Entregue</p>
                                                </div>
                                                @else
                                                <div class="text-left alert alert-danger col-12 py-1"> Essa compra está cancelada, para mais informações entre em contato com o administrador.</div>
                                                @endif
                                            </div>
                                            <hr>
                                            <section id="lin_1">
                                                <div class="card-body p-0">
                                                    <div class="table-responsive text-center">
                                                        <table class="table-striped table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Produtos do carrinho</th>
                                                                    <th>Quantidades</th>
                                                                    <th>Valor unitário</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($pedido->RelationProdutos as $produto)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex text-left">
                                                                                <div class="pl-5 my-auto">
                                                                                    <img src="{{ asset('storage/app/'.$produto->RelationProdutos->RelationImagensPrincipal->first()->caminho) }}" alt="Imagem atual" style="height: auto; width: 70px;" class="border rounded">
                                                                                </div>
                                                                                <div class="px-3">
                                                                                    <a href="{{route('editar.produtos', $produto->RelationProdutos->id)}}" class="text-decoration-none">
                                                                                        <p class="n_pedido my-auto not-espaco">
                                                                                            <b>{{$produto->RelationProdutos->nome}}</b>
                                                                                        </p>
                                                                                    </a>
                                                                                    <label>{{$produto->RelationProdutos->RelationMarcas->nome}}</label>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <label>{{ $produto->quantidade }}</label>
                                                                        </td>
                                                                        <td>
                                                                            <label>R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</label>
                                                                        </td>
                                                                        <td>
                                                                            <label>R$ {{ number_format($produto->valor_total, 2, ',', '.') }}</label>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /RESUMO -->

                        <!-- TRANSAÇÃO -->
                        <div class="tab-pane fade" id="transacoes" role="tabpanel" aria-labelledby="transacoes-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12 border rounded p-4">
                                        <div class="pb-3 d-flex">
                                            <label style="font-size: 18px !important;">Transação <b>#{{ $pedido->id_transacao }}</b></label>
                                        </div>
                                        <div>
                                            <div class="py-2 col">
                                                @if($pedido->RelationFormasPagamento->cod == 'card_credit')
                                                <img data-v-a542e072="" src="http://download.seaicons.com/icons/iconsmind/outline/512/Credit-Card-3-icon.png" width="45" class="border rounded icon-payment mr-2 p-2">
                                                <span class="h-100 my-auto font-weight-bold" style="font-size: 18px !important;">VISA</span>
                                                <div class="py-3">
                                                    <p class="mb-2 not-espaco">******** 2132 </p>
                                                    <p class="mb-2 not-espaco">Titular do cartão: <span><b>BRENO DE CARVALHO MIRANAD</b></span></p>
                                                    <p class="mb-2 not-espaco">Documento do titular: <span><b>121.489.666-93</b></span></p>
                                                </div>
                                                <div>
                                                    <h3>R$ {{ number_format($pedido->valor_total, 2, ",", ".") }}</h3> 
                                                    <h6 class="f15">em 3x de R$ 73,34</h6> 
                                                </div>
                                                <div class="transaction_status mt10 f11 bold">
                                                    <div class="my-auto status badge badge-warning">
                                                        Aguardando pagamento
                                                    </div>
                                                    <small class="font-weight-bold">em 26/03/2020 as 12:13:01</small>
                                                </div>
                                                @elseif($pedido->RelationFormasPagamento->cod == 'boleto')
                                                <img src="https://github.bubbstore.com/svg/billet.svg" width="45" class="border rounded icon-payment mr-2 p-2">
                                                <span class="h-100 my-auto font-weight-bold" style="font-size: 18px !important;">Boleto bancário</span>
                                                <div>
                                                    <h3 class="mt-2">R$ {{ number_format($pedido->valor_total, 2, ",", ".") }}</h3>
                                                </div>
                                                <div class="my-auto status badge badge-warning">Aguardando pagamento
                                                </div>
                                                <small class="font-weight-bold">em 26/03/2020 as 12:13:01</small>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="pb-3">
                                            <div class="col-4">
                                                <p class="mb-0">Afiliação: Pagar.me - Comprecá MarketPlace</p>
                                                <p class="mb-0">ID-pagar.me: <b id="transactions">10.11.26.1</b>
                                                    <a href="javascript:" class="copiando">
                                                        <i class="far fa-copy ml5"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-8 mr-auto text-right">
                                                <div class="buttons">
                                                    <a href="javascript:void(0)" class="btn btn-icon icon-left btn-danger shadow-none" id="btn-cancelar"><i class="fas fa-times"></i> Cancelar transação</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /TRANSAÇÃO -->
                        
                        <!-- NOTA FISCAL -->
                        <div class="tab-pane fade" id="nota" role="tabpanel" aria-labelledby="nota-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if($pedido->RelationStatus->last()->RelationDados->order == 1 && !isset($pedido->RelationNotas))
                                        <div class="alert alert-light">
                                            <div class="alert-title">
                                                <b>Esse pedido ainda não possui nota fiscal</b>
                                            </div>
                                            <div>
                                                <span>Você precisa confirmar o pagamento do pedido para prosseguir com a Nota Fiscal.</span>
                                            </div>
                                        </div>
                                    @elseif($pedido->RelationStatus->last()->RelationDados->order > 1 && $pedido->RelationStatus->last()->RelationDados->order < 9 && isset($pedido->RelationNotas))
                                        <div class="border rounded">
                                            <div class="valor border-0 d-flex">
                                                <div class="col-6 p-4 d-block px-5">
                                                    <h1 class="resumo_title border-0 mb-0 d-block">Número da nota</h1>
                                                    <h5 id="numero_nota">{{(isset($pedido->RelationNotas->numero_nota) ? $pedido->RelationNotas->numero_nota : '-')}}</h5>
                                                </div>
                                                <div class="col-6 p-4">
                                                    <h1 class="resumo_title border-0 mb-0 d-block">Data de emissão</h1>
                                                    <h5 id="data_emissao">{{(isset($pedido->RelationNotas->data_emissao) ? date('d/m/Y', strtotime($pedido->RelationNotas->data_emissao)) : '-')}}</h5>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="px-5 pt-4">
                                                <div>
                                                    <label class="d-block mb-0 not-espaco">Número de série</label>
                                                    <label class="font-weight-bold" id="numero_serie">{{(isset($pedido->RelationNotas->numero_serie) ? $pedido->RelationNotas->numero_serie : '-')}}</label>
                                                    <a href="javascript:" class="copiando">
                                                            <i class="far fa-copy ml5"></i>
                                                        </a>
                                                </div>
                                                <div>
                                                    <label class="d-block mb-0 not-espaco">Chave</label>
                                                    <label class="font-weight-bold" id="chave">{{(isset($pedido->RelationNotas->chave) ? $pedido->RelationNotas->chave : '-')}}</label>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="">
                                                        <label class="d-block mb-0 not-espaco">Valor da nota</label>
                                                        <label class="font-weight-bold">R$ {{number_format($pedido->valor_total, 2, ",", ".")}}</label>
                                                    </div>
                                                    <div class="mx-5">
                                                        <label class="d-block mb-0 not-espaco">Valor dos produtos</label>
                                                        <label class="font-weight-bold">R$ {{number_format($pedido->valor_produtos, 2, ",", ".")}}</label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="d-block mb-0 not-espaco">URL da Nota</label>
                                                    <label class="font-weight-bold" id="url_nota">{{(isset($pedido->RelationNotas->url_nota) ? $pedido->RelationNotas->url_nota : '-')}}</label>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12 text-center pb-4">
                                                <a href="javascript:void(0)" class="btn btn-outline-secondary col-2 shadow-none d-flex align-items-center justify-content-center mx-auto" data-toggle="modal" data-target="#modal-nota" >
                                                    <i class="mdi mdi-pencil px-1"></i> 
                                                    <span> Editar </span>
                                                </a>
                                            </div>
                                        </div>
                                     @else
                                        <div class="alert alert-light">
                                            <span> Ops! Não foi possível identificar uma nota fiscal vinculada ao pedido. </span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <hr>
                                            <a href="javascript:void(0)" class="btn btn-outline-secondary col-2 shadow-none d-flex align-items-center justify-content-center mx-auto" data-toggle="modal" data-target="#modal-nota" >
                                                <i class="mdi mdi-plus px-1"></i> 
                                                <span>Adicionar</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /NOTA FISCAL -->
                    
                        <!-- RASTREAMENTO -->
                        <div class="tab-pane fade" id="rastreamento" role="tabpanel" aria-labelledby="rastreamento-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex col-12">
                                            <div class="col-6 border rounded p-4" style="height: 234px;">
                                                <p class="mb-0">Forma de entrega</p>
                                                <label class="text-uppercase font-weight-bold">
                                                    {{ $pedido->RelationFormasEnvio->nome }}
                                                </label>

                                                <p class="mb-0">Código de rastreamento</p> 
                                                <label class="font-weight-bold">
                                                    {{ (isset($pedido->RelationRastreios->cod_rastreamento) ? $pedido->RelationRastreios->cod_rastreamento : "Não cadastrado") }}
                                                </label>

                                                <p class="mb-0">Link de rastreamento</p> 
                                                <label class="font-weight-bold">
                                                    <a href="{{ (isset($pedido->RelationRastreios->link_rastreamento) ? $pedido->RelationRastreios->link_rastreamento : 'javascript:void(0)' ) }}" target="_blank"> 
                                                        {{ (isset($pedido->RelationRastreios->link_rastreamento) ? $pedido->RelationRastreios->link_rastreamento : "Não cadastrado") }} 
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                @if(!empty($correios))
                                                <div class="table-responsive px-4 pt-3 rounded valor border">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>DATA/HORA</th>
                                                                <th>STATUS/LOCALIDADE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($correios as $correio)
                                                            <tr class="border-top">
                                                                <td class="align-middle">
                                                                    <label class="font-weight-bold">{{$correio['data']}}
                                                                    </label>
                                                                </td>
                                                                <td class="align-middle align-middle pt-3">
                                                                    <div class="not-espaco">
                                                                        <label class="font-weight-bold mb-0">
                                                                            {{$correio['status']}}
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <label>
                                                                            {{str_replace('<label style="text-transform:capitalize;">', '', str_replace('</label>', '', $correio['local']))}}
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @else
                                                <div class="alert alert-light">
                                                    <div class="text-center">
                                                        <b>Informações de rastreamento indisponíveis.</b>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <hr>
                                        <a href="javascript:void(0)" class="btn btn-outline-secondary col-2 shadow-none d-flex align-items-center justify-content-center mx-auto" data-toggle="modal" data-target="#modal-rastreamento" >
                                            <i class="mdi mdi-pencil px-1"></i> 
                                            <span> Editar</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /RASTREAMENTO -->
                    
                        <!-- HISTORICO DE STATUS -->
                        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">ATUALIZADO EM</th>
                                                <th scope="col">STATUS</th>
                                                <th scope="col">OBSERVAÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody class="historico">
                                            @foreach($pedido->RelationStatus as $historico)
                                            <tr>
                                                <td class="align-middle">
                                                    <p class="data_pedido">{{date('d/m/Y H:i:s', strtotime($historico->created_at)) }}</p>
                                                    <p class="temp_pedido">20 minutos</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="my-auto badge badge-{{$historico->RelationDados->color}} text-uppercase">
                                                        <span>{{$historico->RelationDados->nome}}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span>{{$historico->observacoes}}</span>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div>
                                        <a href="javascript:" data-toggle="modal" data-target="#modal-status" class="btn btn-outline-secondary shadow-none col-2">Atualizar status</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /HISTORICO DE STATUS -->
                    
                        <!-- HISTORICO DE PEDIDOS -->
                        <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-light">
                                        <span> O cliente não possui outros pedidos.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /HISTORICO DE PEDIDOS -->
                
                        <!-- EMAILS PARA ENVIO -->
                        <div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-light">
                                        <div class="d-flex">
                                            <div class="col-2">
                                                <i class="icon-mail far fa-envelope"></i>
                                            </div>
                                            <div class="col-6">
                                                <div class="holder-left">
                                                    <a href="javascript:" uk-toggle="target: #modal-email">
                                                        {{$pedido->RelationClientes->nome}}, falta pouco!
                                                    </a> 
                                                    <span>há um dia</span>
                                                    <div>
                                                        Para: 
                                                        <span class="bold">{{$pedido->RelationClientes->email}}</span>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-4 my-auto pr-5 text-right">
                                                <button type="submit" class="btn btn-outline-dark shadow-none">Reenviar e-mail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /EMAILS PARA ENVIO -->
                    </div>
                <!-- /TABS -->
            </div>
        </div>
    </div>
</section>
</div>

    @endsection

    @section('modal')
        @include('admin.pedidos.functions.endereco')
        @include('admin.pedidos.functions.status')
        @include('admin.pedidos.functions.nota')
        @include('admin.pedidos.functions.rastreamento')
    @endsection

    @section('support')
    <script type="text/javascript">
        $(document).ready(function (){
            $('.cep').mask('00000-000');
            $('.modal textarea').summernote({
                toolbar:false
            });

            //Quando o campo cep perde o foco.
            $(".cep").blur(function() {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
                //Verifica se campo cep possui valor informado.
                if (cep != "") {
                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;
                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+cep+"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                $(".error").html('');
                                //Atualiza os campos com os valores da consulta.
                                if(dados.localidade){
                                    $(".cidade").attr('disabled', 'disabled');
                                    $(".cidade").val(dados.localidade.toUpperCase());
                                    $(".cidade1").val(dados.localidade.toUpperCase());
                                }else{
                                    $(".cidade").removeAttr('disabled');
                                }
                                if(dados.uf){
                                    $(".estado").attr('disabled', 'disabled');
                                    $(".estado").val(dados.uf.toUpperCase());
                                    $(".estado1").val(dados.uf.toUpperCase());
                                }else{
                                    $(".estado").removeAttr('disabled');
                                }
                                if(dados.bairro){
                                    $(".bairro").attr('disabled', 'disabled');
                                    $(".bairro").val(dados.bairro.toUpperCase());
                                    $(".bairro1").val(dados.bairro.toUpperCase());
                                }else{
                                    $(".bairro").removeAttr('disabled');
                                }

                            }else {
                                //CEP pesquisado não foi encontrado.
                                $(".error").html('O seu CEP não pode ser encontrado!')
                            }
                        });
                    } else {
                        //cep é inválido.
                        $(".error").html('O seu CEP é inválido!')
                    }
                }else {
                    //cep sem valor, limpa formulário.
                    $(".cidade").val('');
                    $(".estado").val('');
                    $(".cidade").val('');
                    $(".cep").val('');
                    $(".error").html('');
                }
            });

            // Atualiza status
            $('#modal-status #formStatus').on('submit', function(e){
                var table = $('#table').DataTable();
                e.preventDefault();
                $.ajax({
                    url: '{{ route("atualizar.status", $pedido->id) }}',
                    type: 'POST',
                    data: $('#modal-status #formStatus').serialize(),
                    beforeSend: function(){
                        $('#modal-status #formStatus').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                    },
                    success: function(data){
                        $('#modal-status #formStatus').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Status alterado com sucesso!</label></div>');
                        setTimeout(function(){
                             location.reload();
                        }, 800);
                    }, error: function (data) {
                        setTimeout(function(){
                            $('#modal-status #formStatus').removeClass('d-none');
                            $('.carregamento').html('');
                            if(!data.responseJSON){
                                console.log(data.responseText);
                                $('#modal-status #err').html(data.responseText);
                            }else{
                                $('#modal-status #err').html('');
                                $('input').removeClass('border border-danger');
                                $.each(data.responseJSON.errors, function(key, value){
                                    $('#modal-status #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                    $('input[name="'+key+'"]').addClass('border border-danger');
                                });
                            }
                        }, 500);
                    }
                });
            });

            // Adicionando nota fiscal
             $('#modal-nota #formNotas').on('submit', function(e){
                var table = $('#table').DataTable();
                e.preventDefault();
                $.ajax({
                    url: '{{ route("atualizar.nota", $pedido->id) }}',
                    type: 'POST',
                    data: $('#modal-nota #formNotas').serialize(),
                    beforeSend: function(){
                        $('#modal-nota #formNotas').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                    },
                    success: function(data){
                        $('#modal-nota #formNotas').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Informação inserida com sucesso!</label></div>');
                        setTimeout(function(){
                             location.reload();
                        }, 800);
                    }, error: function (data) {
                        setTimeout(function(){
                            $('#modal-nota #formNotas').removeClass('d-none');
                            $('.carregamento').html('');
                            if(!data.responseJSON){
                                console.log(data.responseText);
                                $('#modal-nota #err').html(data.responseText);
                            }else{
                                $('#modal-nota #err').html('');
                                $('input').removeClass('border border-danger');
                                $.each(data.responseJSON.errors, function(key, value){
                                    $('#modal-nota #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                    $('input[name="'+key+'"]').addClass('border border-danger');
                                });
                            }
                        }, 800);
                    }
                });
            });
            
            // Adicionando código de rastreamento
             $('#modal-rastreamento #formRastreamento').on('submit', function(e){
                var table = $('#table').DataTable();
                e.preventDefault();
                $.ajax({
                    url: '{{ route("atualizar.rastreamento", $pedido->id) }}',
                    type: 'POST',
                    data: $('#modal-rastreamento #formRastreamento').serialize(),
                    beforeSend: function(){
                        $('#modal-rastreamento #formRastreamento').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                    },
                    success: function(data){
                        $('#modal-rastreamento #formRastreamento').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Informação inserida com sucesso!</label></div>');
                        
                        setTimeout(function(){
                             location.reload();
                        }, 800);
                    }, error: function (data) {
                        setTimeout(function(){
                            $('#modal-rastreamento #formRastreamento').removeClass('d-none');
                            $('.carregamento').html('');
                            if(!data.responseJSON){
                                console.log(data.responseText);
                                $('#modal-rastreamento #err').html(data.responseText);
                            }else{
                                $('#modal-rastreamento #err').html('');
                                $('input').removeClass('border border-danger');
                                $.each(data.responseJSON.errors, function(key, value){
                                    $('#modal-rastreamento #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                    $('input[name="'+key+'"]').addClass('border border-danger');
                                });
                            }
                        }, 800);
                    }
                });
            });
            
            // Alterando endereço
             $('#modal-endereco #formEndereco').on('submit', function(e){
                var table = $('#table').DataTable();
                e.preventDefault();
                $.ajax({
                    url: '{{ route("atualizar.endereco", $pedido->id) }}',
                    type: 'POST',
                    data: $('#modal-endereco #formEndereco').serialize(),
                    beforeSend: function(){
                        $('#modal-endereco #formEndereco').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                    },
                    success: function(data){
                        $('#modal-endereco #formEndereco').addClass('d-none');
                        $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Informação alteradas com sucesso!</label></div>');
                        setTimeout(function(){
                             location.reload();
                        }, 800);
                    }, error: function (data) {
                        setTimeout(function(){
                            $('#modal-endereco #formEndereco').removeClass('d-none');
                            $('.carregamento').html('');
                            if(!data.responseJSON){
                                console.log(data.responseText);
                                $('#modal-endereco #err').html(data.responseText);
                            }else{
                                $('#modal-endereco #err').html('');
                                $('input').removeClass('border border-danger');
                                $.each(data.responseJSON.errors, function(key, value){
                                    $('#modal-endereco #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                    $('input[name="'+key+'"]').addClass('border border-danger');
                                });
                            }
                        }, 800);
                    }
                });
            });
        });
    </script>
    @endsection




