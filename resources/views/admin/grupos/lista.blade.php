@extends('admin.layouts.index')

@section('title')
Grupos de usuários
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Grupos de usuários</h1>  
                <label class="px-2 mb-0">{{$grupos}} grupos</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.usuarios')}}">Usuários</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.grupos')}}">Grupos</a></div>
                    <div class="breadcrumb-item active">Ver todos</div>
                </div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1)
                        <div class="d-flex ml-auto col-2 mt-4 button-edit"> 
                            <div class="">
                                <a href="{{ route('adicionar.grupos') }}" class="d-flex my-auto btn waves-effect waves-light"><i class="mdi mdi-plus"></i><b class="px-1"> Novo grupo</b></a>
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
    </div>
</section>
</div>
@endsection

@section('support')
<script type="text/javascript">
    $(document).ready(function (){ 
        $('#table').DataTable({
            deferRender: true,
            order: [2, 'desc'],
            paging: true,
            select: true,
            searching: true,
            destroy: true,
            ajax: "{{ route('listar.grupos') }}",
            serverSide: true,
            "columns": [ 
            { "data": "id","name":"id"},
            { "data": "nome", "name":"nome"},
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
                url: "grupos/status/"+id,
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