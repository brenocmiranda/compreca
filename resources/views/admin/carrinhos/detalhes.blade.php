@extends('admin.layouts.index')

@section('title')
Detalhes carrinho
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">

        <div class="section-header">
            <div class="mx-3">
                <h1>Carrinho: #{{$pedido->num_pedido}}</h1> 
                <small class="px-2">atualizado em {{ date_format($pedido->created_at, "d/m/Y") }} às {{ date_format($pedido->created_at, "H:i:s") }}</small>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.pedidos')}}">Pedidos</a></div>
                    <div class="breadcrumb-item "><a href="{{route('exibir.carrinhos')}}">Carrinhos</a></div>
                    <div class="breadcrumb-item active">Detalhes</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- DADOS DO PEDIDO -->
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="col-12 p-0">
                                <div class="d-flex">

                                    <div class="col-4 p-4 cliente">
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

                                    <div class="col-4 p-4 entrega">
                                        <h1 class="resumo_title">Entrega</h1>
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

                                    <div class="col-4 p-4 valor border-right border-top border-bottom">
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


@section('support')
<script type="text/javascript">
    $(document).ready(function (){
        
    });
</script>
@endsection




