@extends('admin.layouts.index')

@section('title')
Pedidos
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Pedidos</h1> 
                <label class="px-2 mb-0">{{$pedidos}} pedidos</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="{{route('exibir.pedidos')}}">Pedidos</a></div>
                    <div class="breadcrumb-item active">Ver todos</div>
                </div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="row">
                <div class="col-12">  
                    <div class="buttons d-flex">
                        <button class="mx-auto border btn btn-light shadow-none" value="AGUARDANDO PAGAMENTO"><span class="text-wrap">AGUARDANDO PAGAMENTO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="PEDIDO AUTORIZADO"><span>PEDIDO AUTORIZADO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="PAGAMENTO APROVADO"><span>PAGAMENTO APROVADO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="PRODUTOS EM SEPARAÇÃO"><span>EM SEPARAÇÃO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="FATURADO"><span>FATURADO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="PRONTO PARA ENVIO"><span>PRONTO PARA ENVIO</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="EM TRANSPORTE"><span>EM TRANSPORTE</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="ENTREGUE"><span>ENTREGUE</span></button>

                        <button class="mx-auto border btn btn-light shadow-none" value="CANCELADO"><span>CANCELADO</span></button>
                    </div>
                    
                    <hr>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive col-12">
                                <table class="w-100 table table-striped text-center" id="table">
                                    <thead>
                                        <tr class="cab">
                                            <th>Transação</th>
                                            <th>Número do pedido</th>
                                            <th>Data</th>
                                            <th>Total</th>
                                            <th>Status</th>
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
                ajax: "{{ route('listar.pedidos') }}",
                serverSide: true,
                "columns": [ 
                { "data": "transacao","name":"transacao"},
                { "data": "cliente", "name":"cliente"},
                { "data": "data", "name":"data"},
                { "data": "valor","name":"valor"},
                { "data": "status1","name":"status1"},
                { "data": "acoes", "name":"acoes"},
                ],
            });

            $('.btn-filter').on('click', function(){
                var table = $('#table').DataTable();
                var filteredData = table.column(4).data().filter(function ( value, index ) {return value == this.value ? true : false;});
            });

            $('.btn-filter').dblclick(function(){
                var table = $('#table').DataTable();
                var filteredData = table.column(4).data().filter('');
            });
        });
    </script>
    @endsection