@extends('admin.layouts.index')

@section('title')
Carrinhos Abandonados
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Carrinhos abandonados</h1>  
                <label class="px-2 mb-0">{{$carrinhos}} carrinhos</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.pedidos')}}">Pedidos</a></div>
                    <div class="breadcrumb-item "><a href="{{route('exibir.carrinhos')}}">Carrinhos</a></div>
                    <div class="breadcrumb-item active">Ver todos</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive col-12 text-center">
                                <table class="w-100 table table-striped w-100" id="table">
                                    <thead>
                                        <tr class="cab">
                                            <th>Nº Carrinho</th>
                                            <th>Cliente</th>
                                            <th>Atualizado em</th>
                                            <th>Valor da compra</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('support')
<script type="text/javascript">
    $(document).ready(function (){ 
        $('#table').DataTable({
            deferRender: true,
            order: [1, 'asc'],
            paging: true,
            select: true,
            searching: true,
            destroy: true,
            ajax: "{{ route('listar.carrinhos') }}",
            serverSide: true,
            "columns": [ 
            { "data": "num_pedido","name":"num_pedido"},
            { "data": "cliente", "name":"cliente"},
            { "data": "data", "name":"data"},
            { "data": "valor","name":"valor"},
            { "data": "acoes", "name":"acoes"},
            ],
        });
    });
</script>
@endsection