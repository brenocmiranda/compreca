@extends('admin.layouts.index')

@section('title')
Novo usuário
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Novo usuário</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.usuarios')}}">Usuários</a></div>
                    <div class="breadcrumb-item active">Adicionar</div>
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
                    <form method="POST" action="{{ route('salvar.usuarios') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">                                

                                <div class="card" id="card-1">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Informações básicas</h5>
                                    </div>
                                    <div class="card-body d-flex">
                                        <div class="col-8">
                                            <div class="form-group col-12">
                                                <label class="custom-switch px-0">
                                                    <input type="checkbox" name="status" class="custom-switch-input" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description"><b>Ativo</b></span>
                                                </label>
                                            </div>
                                            <div class="form-group col-10">
                                                <label>Nome <i class="text-danger">*</i></label>
                                                <input type="text" name="nome" class="form-control" placeholder="Usuário 1" required>
                                            </div>
                                            <div class="form-group col-5">
                                                <label>Documento <small>(CPF)</small> <i class="text-danger">*</i></label>
                                                <input type="text" name="documento" class="documento form-control" placeholder="000.000.000-00" required>
                                            </div>
                                            <div class="form-group col-8">
                                                <label>E-mail <i class="text-danger">*</i></label>
                                                <input type="email" name="email" class="form-control" placeholder="suporte@compreca.com.br" required>
                                            </div>
                                            <div class="form-group col-10">
                                                <label>Lojas <i class="text-danger">*</i></label>
                                                <div class="d-flex align-items-center">
                                                    <div class="col-8 p-0">
                                                        <select class="id_loja" name="id_loja" id="listaLojas" {{(Auth::guard('admin')->user()->id_grupo == 1 ? 'required' : 'disabled') }}>
                                                            <option disabled="disabled">Selecione</option>
                                                            <option value="">Nenhum</option>
                                                            @foreach($lojas as $loja)
                                                                <option value="{{$loja->id}}" {{(Auth::guard('admin')->user()->id_loja == $loja->id ? 'selected' : '')}}>{{$loja->nome}}</option>
                                                            @endforeach
                                                        </select>
                                                        <small>
                                                            <a href="javascript:void(0)" class="" title="Nova loja" data-toggle="modal" data-target="#usuarios-lojas">
                                                                <i class="mdi mdi-plus"></i> 
                                                                <span class="px-1">Cadastrar uma nova loja</span>
                                                            </a>
                                                        </small>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-group col-8">
                                                <label>Grupos de permissões <i class="text-danger">*</i></label>
                                                <div class="d-flex align-items-center">
                                                    <div class="col-7 p-0">
                                                        <select class="id_grupo" name="id_grupo" id="listaGrupos" required>
                                                            <option disabled="disabled">Selecione</option>
                                                            @foreach($grupos as $grupo)
                                                                <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                                                            @endforeach
                                                        </select>
                                                        <small>
                                                            <a href="javascript:void(0)" class="" title="Novo grupo" data-toggle="modal" data-target="#usuarios-grupos">
                                                                <i class="mdi mdi-plus"></i> 
                                                                <span class="px-1">Cadastrar uma novo grupo</span>
                                                            </a>
                                                        </small>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="col-12 form-group text-center">
                                                <h6 class="col-12 mb-0">Selecione a imagem perfil</h6>
                                                <small>Formatos de imagem aceitos: .png, .jpg ou .svg</small>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="border p-3 col-9 rounded-circle text-center mx-auto">
                                                            <img class="w-100 rounded-circle" id="PreviewImage" src="{{ asset('public/admin/img/user.png').'?'.rand() }}" style="height: 190px;" >
                                                            <input type="file" class="px-0 col-12 position-absolute mx-auto h-100 pointer" style="opacity: 0; top: 0%; left: 0%" accept="image/*" name="id_imagem" id="id_imagem" onchange="image(this);" title="Selecione sua imagem">
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-12 mb-5 text-right">
                                    <a href="{{ route('exibir.usuarios') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
                                    <button class="btn waves-effect waves-light col-2 mx-1">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('modal')
    @include('admin.usuarios.lojas')
    @include('admin.usuarios.grupos')
@endsection

@section('support')
<script type="text/javascript">
    $(document).ready(function (){
        // Checkbox modal
        $('#acesso_total').on('click', function(){
            if($(this).is(':checked')){
                $('#formGrupos input[type=checkbox]').attr('checked', 'checked');
            }else{
                $('#formGrupos input[type=checkbox]').removeAttr('checked');
            }
        });

        // Mascaras
        var options = {
            onKeyPress: function (cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('#documento').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }
        $('#documento').length > 11 ? $('#documento').mask('00.000.000/0000-00', options) : $('#documento').mask('000.000.000-00#', options);
        $('.documento').mask('000.000.000-00');
        $('.telefone').mask('(00) 00000-0000');
        $('.cep').mask('00000-000');
        $('.modal textarea').summernote({
            toolbar: false,
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

        // Pré-visualização da imagem
        $('#id_imagem').on('change', function() {
            if(this.files && this.files[0]){
                $('#PreviewLogo').remove('');
                var reader = new FileReader();
                reader.onload = function (oFREvent){
                    $('div#PreviewImageLoja').append('<img class="position-absolute align-self-center" id="PreviewLogo" src="'+oFREvent.target.result+'" class="rounded" style="height: 100px;width: 220px;z-index:1000">');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Pré-visualização de fundo
        $('#id_imagem1').on('change', function() {
            if(this.files && this.files[0]){
                $('#PreviewFundo').remove('');
                var reader = new FileReader();
                reader.onload = function (oFREvent){
                    $('div#PreviewImageLoja').append('<img class="w-100 rounded" id="PreviewFundo" src="'+oFREvent.target.result+'" class="rounded" style="height: 350px;filter: opacity(0.7) brightness(0.3)">');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Pré-visualização da logo
        $('#id_logomarca').on('change', function() {
            if(this.files && this.files[0]){
                $('#PreviewLogo').remove('');
                var reader = new FileReader();
                reader.onload = function (oFREvent){
                    $('div#PreviewImageLoja').append('<img class="position-absolute align-self-center" id="PreviewLogo" src="'+oFREvent.target.result+'" class="rounded" style="height: 100px;width: 170px;z-index:1000">');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Adicionando as lojas
        $('#usuarios-lojas #formLojas').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url: '{{ route("salvar.lojas") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#usuarios-lojas #formLojas').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Loja adicionada com sucesso!</label></div>');
                    
                    $('#listaLojas').formSelect('destroy');
                    $(data).each(function(index, element){
                        $('#listaLojas').append('<option value="'+element.id+'">'+element.nome+'</option>');
                    });
                    $('#listaLojas').formSelect();

                    setTimeout(function(){
                        $('#usuarios-lojas #formLojas').each (function(){
                            this.reset();
                        });
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#usuarios-lojas #formLojas').removeClass('d-none');
                        $('#usuarios-lojas').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#usuarios-lojas #formLojas').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#usuarios-lojas #err').html(data.responseText);
                        }else{
                            $('#usuarios-lojas #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#usuarios-lojas #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                $('input[name="'+key+'"]').addClass('border border-danger');
                            });
                        }
                    }, 800);
                }
            });
        });

        // Adicionando os grupos
        $('#usuarios-grupos #formGrupos').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("salvar.grupos") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#usuarios-grupos #formGrupos').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Grupo adicionado com sucesso!</label></div>');

                    $('#listaGrupos').formSelect('destroy');
                    $(data).each(function(index, element){
                        $('#listaGrupos').append('<option value="'+element.id+'">'+element.nome+'</option>');
                    });
                    $('#listaGrupos').formSelect();

                    setTimeout(function(){
                        $('#usuarios-grupos #formGrupos').each (function(){
                            this.reset();
                        });
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#usuarios-grupos #formGrupos').removeClass('d-none');
                        $('#usuarios-grupos').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#usuarios-grupos #formGrupos').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#usuarios-grupos #err').html(data.responseText);
                        }else{
                            $('#usuarios-grupos #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#usuarios-grupos #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
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
