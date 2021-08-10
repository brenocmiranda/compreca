@extends('admin.layouts.index')

@section('title')
Configurações
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Usuários</h1>  
                <label class="px-2 mb-0">{{$usuarios}} usuários</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('configuracoes')}}">Configurações</a></div>
                    <div class="breadcrumb-item active"><a href="{{route('configuracoes.usuarios')}}">Usuários</a></div>
                    <div class="breadcrumb-item">Ver todos</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1)
                        <div class="d-flex ml-auto col-2 mt-3 button-edit"> 
                            <div class="">
                                <a href="{{ route('configuracoes.adicionar.usuarios') }}" class="d-flex my-auto btn waves-effect waves-light"><i class="mdi mdi-plus"></i><b class="px-1"> Novo usuário</b></a>
                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive col-12">
                                <table class="w-100 table table-striped text-center" id="table">
                                    <thead>
                                        <tr class="cab">
                                            <th>ID #</th>
                                            <th>Nome</th>
                                            <th>Loja</th>
                                            <th>Grupo</th>
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
            order: [1, 'desc'],
            paging: true,
            select: true,
            searching: true,
            destroy: true,
            ajax: "{{ route('configuracoes.listar.usuarios') }}",
            serverSide: true,
            "columns": [ 
            { "data": "id","name":"id"},
            { "data": "usuario", "name":"usuario"},
            { "data": "loja","name":"loja"},
            { "data": "grupo","name":"grupo"},
            { "data": "status1", "name":"status1"},
            { "data": "acoes", "name":"acoes"},
            ],
        });
    });

    function alterarStatus(id){
        swal({
          title: "Tem certeza que deseja alterar o status?",
          icon: "warning",
          buttons: ["Cancelar", "Alterar"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "usuarios/status/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    $('#table').DataTable().ajax.reload();
                }
            });
            swal("Informações alteradas com sucesso!", {
              icon: "success",
            });
          } else {
            swal.close();
          }
        });
    }   
</script>
@endsection