@extends('admin.layouts.index')

@section('title')
Menu
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Menu</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></div>
                    <div class="breadcrumb-item active">Menu</div>
                </div>
            </div>
        </div>

        @if(Session::has('confirm'))
        <p class="alert alert-{{ Session::get('confirm')['class'] }} alert-dismissible">
            {{ Session::get('confirm')['mensagem'] }}
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </p>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" id="card-1">
                        <div class="card-header py-0">
                            <h5 class="section-title">Tópicos</h5>

                             <button class="d-flex ml-auto btn waves-effect waves-light align-items-center" data-toggle="modal" data-target="#new-topico"> 
                                <i class="mdi mdi-plus pr-2"></i><span>Novo tópico</span>
                            </button>
                        </div>
                        <div class="card-body">
                            
                            <div class="row col-12 m-auto">
                                @if(isset($menu[0]))
                                    <nav class="shadow-none w-100">
                                      <div class="nav-wrapper bg-light rounded">
                                        <ul id="nav-mobile" class="h-100 row my-auto align-items-center align-self-center justify-content-center">
                                            @foreach($menu->sortBy('nome') as $item)
                                                <li class="row px-3 my-auto">
                                                    <a href="{{url($item->tagName)}}" target="_blank" class="text-primary d-block">
                                                       {{$item->nome}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                      </div>
                                    </nav>

                                    <hr class="col-12 row">

                               
                                    @foreach($menu->sortBy('nome') as $item)
                                    <div class="text-center col-2 p-2">
                                        <div class="border rounded p-2 mb-3 text-dark">
                                            {{$item->nome}}
                                            <br>
                                            <small class="text-muted">({{$item->tagName}})</small>
                                            <br>
                                            <div class="row mb-0">
                                                <a href="javascript:void(0)" class="p-2 ml-auto" onclick="editarTopico('{{$item->id}}')">
                                                    <small>Editar</small>
                                                </a>
                                                <a href="javascript:void(0)" class="p-2 mr-auto" onclick="deleteTopico('{{$item->id}}')">
                                                    <small>Deletar</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="col-12 p-0">
                                        <div class="alert alert-light">
                                            <label class="mb-0 text-dark">Você não possui nenhum tópico cadastrado.</label>
                                        </div>
                                    </div>
                                @endif
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

@section('modal')
<div class="modal fade" id="new-topico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header">
                    <div class=" mx-3">
                        <h3 class="modal-title">Novo tópico </h3>
                        <label class="mb-0"> Cadastre uma novo tópico que estará disponível no menu.</label>
                    </div>
                    <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formNewTopico" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-7">
                            <label>Nome <small>(Nome que estará visível para os clientes)</small></label>
                            <input type="text" name="nome" class="form-control" placeholder="Calçados" value="">
                        </div>
                        <div class="form-group col-5">
                            <label>Tag name <small>(TAG que será pesquisada no banco)</small></label>
                            <input type="text" name="tagName" class="tagName form-control" placeholder="calcados" value="">
                        </div>

                        <hr>

                        <div class="modal-footer py-1">
                            <div class="col-12 text-center">
                                <button class="btn btn-secondary col-3 mx-1 shadow-none" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                <button class="btn waves-effect waves-light col-3 mx-1 shadow-none">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-topico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header">
                    <div class=" mx-3">
                        <h3 class="modal-title">Editr tópico </h3>
                        <label class="mb-0"> Edite as informações do tópico que estará disponível no menu.</label>
                    </div>
                    <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formEditTopico" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="id">
                        <div class="form-group col-7">
                            <label>Nome <small>(Nome que estará visível para os clientes)</small></label>
                            <input type="text" name="nome" class="nome form-control" placeholder="Calçados">
                        </div>
                        <div class="form-group col-5">
                            <label>Tag name <small>(TAG que será pesquisada no banco)</small></label>
                            <input type="text" name="tagName" class="tagName form-control" placeholder="calcados">
                        </div>

                        <hr>

                        <div class="modal-footer py-1">
                            <div class="col-12 text-center">
                                <button class="btn btn-secondary col-3 mx-1 shadow-none" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                <button class="btn waves-effect waves-light col-3 mx-1 shadow-none">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('support')
<script type="text/javascript">
    function editarTopico(id){
        $.ajax({
            url: '{{ url("painel/marketplace/menu/detalhes") }}/'+id,
            type: 'GET',
            success: function(data){
                $('#formEditTopico .id').val(data.id);
                $('#formEditTopico .nome').val(data.nome);
                $('#formEditTopico .tagName').val(data.tagName);
                $('#edit-topico').modal('show');
            },
        });
    }

    function deleteTopico(id){
        swal({
          title: "Tem certeza que deseja remover?",
          icon: "warning",
          buttons: ["Cancelar", "Deletar"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('painel/marketplace/menu/delete')}}/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    swal("Tópico removido com sucesso!", {
                      icon: "success",
                    });
                    location.reload();
                }
            });
          } else {
            swal.close();
          }
        });
    }

    $(document).ready(function (){
        $('.tagName').mask('AAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
            A: {pattern: /[a-z]/},
        }});

        // Adicionando as marcas
        $('#new-topico #formNewTopico').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ route("adicionar.menu.marketplace") }}',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#new-topico #formNewTopico').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('#new-topico #formNewTopico').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Tópico adicionado com sucesso!</label></div>');
                    location.reload();
                }, error: function (data) {
                    setTimeout(function(){
                        $('#new-topico #formNewTopico').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#new-topico #err').html(data.responseText);
                        }else{
                            $('#new-topico #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#new-topico #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                $('input[name="'+key+'"]').addClass('border border-danger');
                            });
                        }
                    }, 800);
                }
            });
        });

        // Adicionando as marcas
        $('#edit-topico #formEditTopico').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ url("painel/marketplace/menu/editar") }}/'+$('#formEditTopico .id').val(),
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#edit-topico #formEditTopico').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('#edit-topico #formEditTopico').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Informações alteradas com sucesso!</label></div>');
                    location.reload();
                }, error: function (data) {
                    setTimeout(function(){
                        $('#edit-topico #formEditTopico').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#edit-topico #err').html(data.responseText);
                        }else{
                            $('#edit-topico #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#edit-topico #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
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