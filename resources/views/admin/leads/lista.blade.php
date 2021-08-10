@extends('admin.layouts.index')

@section('title')
Leads
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Leads</h1>  
                <label class="px-2 mb-0">{{$leads}} leads</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="{{route('exibir.clientes')}}">Clientes</a></div>
                    <div class="breadcrumb-item "><a href="{{route('exibir.leads')}}">Leads</a></div>
                    <div class="breadcrumb-item active">Ver todos</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1)
                        <div class="d-flex ml-auto col-2 mt-4 button-edit"> 
                            <div class="">
                                <a href="{{ route('adicionar.leads') }}" class="d-flex my-auto btn waves-effect waves-light"><i class="mdi mdi-plus"></i><b class="px-1"> Novo lead</b></a>
                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive col-12 text-center">
                                <table class="w-100 table table-striped w-100" id="table">
                                    <thead>
                                        <tr class="cab">
                                            <th>ID #</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
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
            ajax: "{{ route('listar.leads') }}",
            serverSide: true,
            "columns": [ 
            { "data": "id","name":"id"},
            { "data": "nome", "name":"nome"},
            { "data": "email", "name":"email"},
            { "data": "tel_contato","name":"tel_contato"},
            { "data": "acoes", "name":"acoes"},
            ],
        });
    });
</script>
@endsection
