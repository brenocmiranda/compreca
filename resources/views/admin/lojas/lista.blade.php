@extends('admin.layouts.index')

@section('title')
Lojas
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Lojas</h1>  
                <label class="px-2 mb-0">{{count($lojas)}} lojas</label>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.lojas')}}">Lojas</a></div>
                    <div class="breadcrumb-item active">Ver todos</div>
                </div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
                        <div class="d-flex ml-auto col-2 mt-4 button-edit"> 
                            <div class="">
                                <a href="{{ route('adicionar.lojas') }}" class="d-flex my-auto btn waves-effect waves-light"><i class="mdi mdi-plus"></i><b class="px-1"> Nova loja</b></a>
                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="col-sm-12 header-cab">
                                <div class="mb-4 col-8 mx-0 row">
                                    <button class="my-auto btn waves-effect waves-light btn-icon icon-left col-2 w-100" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-filter"></i> Filtrar</button>
                                    <input type="search" class="form-control col-6 mx-4 rounded btn-select " placeholder="Encontre aqui o que procura..." aria-controls="table">
                                    <button class="my-auto btn waves-effect waves-light dropdown-toggle col-2 w-100" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exportar</button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-file-excel"></i> em Excel</a> 
                                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-file-pdf"></i> em PDF</a> 
                                    </div>
                                </div>
                            </div>

                            <ul class="row mt-4 mx-2" id="listPage">
                                @if(count($lojas))
                                    @foreach($lojas as $loja)
                                    <li>
                                        <div class="loja card mx-2 border rounded" style="width: 15rem;">
                                            <div class="card-img-top d-flex align-items-center justify-content-center">
                                                <img class="position-absolute m-auto" src="{{ (asset($loja->RelationLogomarca->caminho) ? asset('storage/app/'.$loja->RelationLogomarca->caminho) : asset('public/admin/img/system/product.png')) }}" alt="Card image cap" style="width:150px; z-index:999">
                                                <img class="w-100 rounded-top" src="{{ (asset($loja->RelationImagens->caminho) ? asset('storage/app/'.$loja->RelationImagens->caminho) : asset('public/admin/img/system/product.png')) }}" alt="Card image cap" style="height:150px;"> 
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="d-flex">
                                                        <b class="text-truncate">{{$loja->nome}}</b>
                                                        <div class="px-2 d-flex align-items-center text-{{($loja->status==1 ? 'success' : 'danger')}}" id="statusBoolean{{$loja->id}}"><i class="fas fa-circle"></i></div>
                                                        
                                                    </h5>
                                                    <label class="card-text d-block">{{$loja->email}}</label>
                                                    <label class="card-text d-block">{{$loja->telefone}}</label>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end">
                                                    @if($loja->status == 1)
                                                        <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton{{$loja->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                                            <a class="dropdown-item has-icon" href="{{route('editar.lojas', $loja->id)}}">
                                                                <i class="mdi mdi-pencil"></i> Editar informações
                                                            </a> 
                                                            <a class="dropdown-item has-icon" id="status{{$loja->id}}" href="javascript:void(0)" onClick="alterarStatus({{$loja->id}})">
                                                                <i class="mdi mdi-close"></i> Desativar loja
                                                            </a> 
                                                        </div>
                                                    @else
                                                        <button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton{{$loja->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                                            <a class="dropdown-item has-icon" href="{{route('editar.lojas', $loja->id)}}">
                                                                <i class="mdi mdi-pencil"></i> Editar informações
                                                            </a> 
                                                            <a class="dropdown-item has-icon" id="status{{$loja->id}}" href="javascript:void(0)" onClick="alterarStatus({{$loja->id}})">
                                                                <i class="mdi mdi-check"></i> Ativar loja
                                                            </a> 
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @else
                                    <div class=" col-12 bg-light rounded">
                                        <p class="text-left m-3"><b>Não foi encontrado nenhum registro na lista.</b></p>
                                    </div>
                                @endif
                            </ul>
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
       $('input[type="search"]').on('keyup', function(){
            var texto = this.value;
            $(".loja").parent('li').css("display", "inline-block");

            $(".loja").parent('li').each(function(){
              if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0)
                $(this).css("display", "none");
              $(".loja").parent('li').removeClass("d-inline-block");
            });
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
                url: "lojas/status/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    if(data.status == 0){
                        $('#status'+id).html('<i class="mdi mdi-check"></i> Ativar loja');
                        $('#statusBoolean'+id).removeClass('text-success');
                        $('#statusBoolean'+id).addClass('text-danger');
                    }else{
                        $('#status'+id).html('<i class="mdi mdi-close"></i> Desativar loja');
                        $('#statusBoolean'+id).removeClass('text-danger');
                        $('#statusBoolean'+id).addClass('text-success');
                    }
                    if(data.mostrar_na_home == 0){
                        $('#home'+id).html('<i class="mdi mdi-check"></i> Mostrar na home');
                        $('#homeBoolean'+id).removeClass('text-success');
                        $('#homeBoolean'+id).addClass('text-danger');
                    }else{
                        $('#home'+id).html('<i class="mdi mdi-close"></i> Ocultar na home');
                        $('#homeBoolean'+id).removeClass('text-danger');
                        $('#homeBoolean'+id).addClass('text-success');
                    }
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