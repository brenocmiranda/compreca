@extends('admin.layouts.index')

@section('title')
Novo produto
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Novo produto</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.produtos')}}">Produtos</a></div>
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

                    <form method="POST" action="{{ route('salvar.produtos') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3 mx-auto">
                                    <div class="col-3 border rounded-lg mx-1 text-center bg-white border-primary" id="variante1" style="cursor: pointer">
                                        <div class="pt-3">
                                            <label class="colorinput mx-2">
                                                <input type="radio" name="variante" value="false" class="colorinput-input" checked>
                                                <span class="colorinput-color bg-light border rounded-circle"></span>
                                            </label>
                                            <i class="mdi mdi-tshirt-crew-outline mdi-24px"></i>
                                        </div>
                                        <div class="py-2">
                                            <label class="font-weight-bold">Produto sem variante</label>
                                        </div>
                                    </div>
                                    <div class="col-3 border rounded-lg mx-1 text-center bg-white" id="variante2" style="cursor: pointer">
                                        <div class="pt-3">
                                            <label class="colorinput mx-2">
                                                <input type="radio" name="variante" value="true" class="colorinput-input">
                                                <span class="colorinput-color bg-light border rounded-circle"></span>
                                            </label>
                                            <i class="mdi mdi-tshirt-crew-outline mdi-24px"></i>
                                            <i class="mdi mdi-tshirt-crew mdi-24px"></i>
                                            <i class="mdi mdi-tshirt-v-outline mdi-24px"></i>
                                        </div>
                                        <div class="py-2">
                                            <label class="font-weight-bold">Produto com variante</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-1">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Informações básicas</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group col-12">
                                            <label class="custom-switch px-0">
                                                <input type="checkbox" name="status" class="custom-switch-input" checked>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description"><b>Ativo</b></span>
                                            </label>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group mb-0">
                                                <label>Tipo de produto <i class="text-danger">*</i></label>
                                            </div>
                                            <div class="selectgroup">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="tipo" value="fisico" class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button p-2 px-3 h-100"><b>Produto Físico</b></span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="tipo" value="digital" class="selectgroup-input">
                                                    <span class="selectgroup-button p-2 px-3 h-100"><b>Produto Digital</b></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Nome do produto <i class="text-danger">*</i></label>
                                            <input type="text" name="nome" class="form-control" placeholder="Ex.: Produto 1" required>
                                        </div>
                                        <div class="form-group col-8">
                                            <label>Marca <i class="text-danger">*</i></label>
                                            <div class="d-flex align-items-center">
                                                <div class="col-6 p-0">
                                                    <select class="id_marca" name="id_marca" id="listaMarcas" required>
                                                        <option disabled="disabled">Selecione</option>
                                                        @foreach($marcas as $marca)
                                                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>
                                                        <a href="javascript:void(0)" class="" title="Nova marca" data-toggle="modal" data-target="#produtos-marcas">
                                                            <i class="mdi mdi-plus"></i> 
                                                            <span class="px-1">Cadastrar uma nova marca</span>
                                                        </a>
                                                    </small>
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-2">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Categorias</h5>
                                        <div class="ml-auto">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#produtos-categorias">+ Cadastrar nova categoria</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="col-6 form-group">
                                                <label>Selecione as categorias <i class="text-danger">*</i></label>
                                                <div class="col-12 p-0">
                                                    <select id="listaCategorias">
                                                        <option disabled="disabled">Selecione</option>
                                                        @foreach($categorias as $categoria)
                                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 p-0 mt-3 rounded">
                                                    <button type="button" class="btn waves-effect waves-light shadow-none d-flex text-white" title="Inserir na tabela" id="addCategoria">
                                                        <i class="mdi mdi-table-column-plus-after"></i> 
                                                        <b class="px-2">Inserir</b>
                                                    </button>
                                                </div>
                                            </div>     

                                            <div class="table-responsive col-6">
                                                <table class="table" id="tableCategoria">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase">Nome da categoria</th>
                                                            <th class="text-center text-uppercase"> Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="notCategorias"> 
                                                            <td>Nenhuma categoria cadastrada</td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card d-none" id="card-3">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Variantes</h5>
                                        <div class="ml-auto">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#produtos-variantes">+ Cadastrar nova variação</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="col-6 form-group">
                                                <label>Selecione as variações <i class="text-danger">*</i></label>
                                                <div class="col-12 p-0">
                                                    <select id="listaVariacoes">
                                                        <option disabled="disabled">Selecione</option>
                                                        @foreach($variacoes as $variacao)
                                                            <option value="{{$variacao->id}}">{{$variacao->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 p-0 mt-3 rounded">
                                                    <button type="button" class="btn waves-effect waves-light shadow-none d-flex text-white" title="Inserir na tabela" id="addVariacoes">
                                                        <i class="mdi mdi-table-column-plus-after"></i> 
                                                        <b class="px-2">Inserir</b>
                                                    </button>
                                                </div>
                                            </div>     

                                            <div class="table-responsive col-6">
                                                <table class="table" id="tableVariacoes">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase">Nome da variação</th>
                                                            <th class="text-uppercase">Valor</th>
                                                            <th class="text-center text-uppercase"> Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="notVariacoes"> 
                                                            <td>Nenhuma variação cadastrada</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-4">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Comercialização</h5>
                                    </div>
                                    <div class="card-body p-0 pt-3">
                                        <div class="form-group col-12 px-5">
                                            <label class="custom-switch px-0">
                                                <input type="checkbox" name="disponivel_venda" class="custom-switch-input" checked>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description"><b>Disponível para venda</b></span>
                                            </label>
                                        </div>
                                        <div class="form-group col-12 px-5">
                                            <div class="d-block">
                                                <div class="form-group mb-0">
                                                    <label>
                                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Código exclusivo para identificar este produto.">
                                                            <div class="">
                                                                <i class="mdi mdi-alert-circle-outline"></i>
                                                            </div>
                                                        </span> Código SKU <i class="text-danger">*</i> 
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control cod_sku col-3" name="cod_sku" onkeyup="this.value = this.value.toUpperCase();" placeholder="D83EGVEEV" required>
                                                <small><a href="javascript:void(0)" class="gerar">Gerar um código aleatório</a></small>
                                            </div>
                                        </div>

                                        <div class="col-5 form-group px-5">
                                            <label>Código de Barras (EAN-13)</label>
                                            <input type="text" class="cod_ean form-control" name="cod_ean" maxlength="13" placeholder="5901234123457">
                                        </div>

                                        <div class="col-3 form-group px-5 mb-5">
                                            <label>Quantidade <i class="text-danger">*</i></label>
                                            <input type="number" class="form-control" name="quantidade" placeholder="Ex.: 20" required>
                                        </div>

                                        <div class="d-flex p-3 bg-light rounded">
                                            <div class="form-group col-4">
                                                <label class="text-dark">Preço de custo </label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">R$</h6>
                                                    <input type="text" class="form-control currency" placeholder="9,99" name="preco_custo">
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label class="text-dark">Preço de venda <i class="text-danger">*</i></label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">R$</h6>
                                                    <input type="text" class="form-control currency" name="preco_venda" placeholder="39,99" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label class="text-dark">Preço promocional</label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">R$</h6>
                                                    <input type="text" class="form-control currency" name="preco_promocional" placeholder="29,99">
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-5">
                                    <div class="card-header py-0 ">
                                        <h5 class="section-title">Peso e Dimensões</h5>
                                    </div>
                                    <div class="card-body d-flex mb-3">
                                        <div class="row col-8">
                                            <div class="form-group col-6">
                                                <label>Peso <i class="text-danger">*</i></label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">KG</h6> 
                                                    <input type="text" class="form-control medida" name="peso">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Largura <i class="text-danger">*</i></label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">cm</h6> 
                                                    <input type="text" class="form-control medida" name="largura">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Altura <i class="text-danger">*</i></label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">cm</h6> 
                                                    <input type="text" class="form-control medida" name="altura">
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Comprimento <i class="text-danger">*</i></label>
                                                <div class="d-flex">
                                                    <h6 class="my-auto mr-3">cm</h6> 
                                                    <input type="text" class="form-control medida" name="comprimento">
                                                </div>
                                            </div>     
                                        </div>
                                        <div class="col-4 text-center my-auto">
                                            <img src="{{ asset('public/admin/img/system/product-dimensions.svg') }}" height="220">
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-6">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Imagens</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12 form-group">
                                            <h6 class="col-12 row mb-0">Selecione a imagem principal <i class="text-danger">*</i></h6>
                                            <small>Formatos de imagem aceitos: .png, .jpg ou .svg</small>
                                            <div class="row mt-3">
                                                <div class="col-4">
                                                    <div class="text-center">
                                                        <div id="PreviewImage" class="image-preview w-100" style="height: 300px;">
                                                          <label for="imagem_principal" id="image-label" class="text-white rounded">Selecione</label>
                                                          <input type="file" accept="image/*" name="imagem_principal" id="imagem_principal" onchange="image(this);">
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-12 form-group">
                                            <h6 class="col-12 row mb-0">Selecione as demais imagens</h6>
                                            <small>Formatos de imagem aceitos: .png, .jpg ou .svg</small>
                                            <div class="row col-12 mt-3 preview">
                                                <div class="border m-2 rounded col-2 d-flex" style="height: 180px;">
                                                    <i class="mdi mdi-plus mdi-36px m-auto"></i>
                                                    <input type="file" class="px-0 col-12 position-absolute mx-auto h-100 pointer" style="opacity: 0; top: 0%; left: 0%" accept=".png, .jpg, .jpeg" id="addFotoGaleria" accept="image/*" title="Selecione mais imagens do produto" multiple>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="card-7">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Detalhes do produto</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group col-12 form-group">
                                            <label>Descrição do produto</label>
                                            <textarea class="summernote" name="descricao"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-12 mb-5 text-right">
                                    <a href="{{ route('exibir.produtos') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
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
    @include('admin.produtos.marcas')
    @include('admin.produtos.categorias')
    @include('admin.produtos.variantes')
@endsection

@section('support')
<script type="text/javascript">
    function removeCategoria(input){
        var id = $(input).parents('tr').find('input[type="hidden"]').val();
        var nome = $(input).parents('tr').find('.name').text();

        // Remove categoria
        if($("#tableCategoria tbody").find('tr').length <= 1){
            $("#tableCategoria tbody").html('<tr class="notCategorias"> <td>Nenhuma categoria cadastrada</td> <td></td> </tr>'); 
        }else{
            $(input).closest('tr').remove();
        }

        // Insere novamente no select
        $('select').formSelect('destroy');
        $('#listaCategorias').append('<option value="'+id+'">'+nome+'</option>');
        $('select').formSelect();
        $('#addCategoria').removeAttr('disabled');
    }

    function removeVariacao(input){
        var id = $(input).parents('tr').find('input[type="hidden"]').val();
        var nome = $(input).parents('tr').find('.name').text();

        // Remove categoria
        if($("#tableVariacoes tbody").find('tr').length <= 1){
            $("#tableVariacoes tbody").html('<tr class="notVariacoes"> <td></td> <td>Nenhuma variação cadastrada</td> <td></td> </tr>'); 
        }else{
            $(input).closest('tr').remove();
        }

        // Insere novamente no select
        $('select').formSelect('destroy');
        $('#listaVariacoes').append('<option value="'+id+'">'+nome+'</option>');
        $('select').formSelect();
        $('#addVariacoes').removeAttr('disabled');
    }

    function removeImagem(id){
         $.ajax({
            url: "removeImagem/"+id,
            type: 'GET',
            success: function(data){ 
               $('#PreviewImage'+id).remove();
            }
        });
    }


    $(document).ready(function (){
        // Pré-visualização de várias imagens no navegador
        $('#addFotoGaleria').on('change', function(event) {
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}');

            if (this.files) {
                for (i = 0; i < this.files.length; i++) {
                    formData.append('imagens[]', this.files[i]);
                }
                
                $.ajax({
                    url: "{{ route('imagens.produtos') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){ 
                        for (i = 0; i < data.length; i++) {
                            $('div.preview').append('<div class="border m-2 rounded col-2 d-flex" id="PreviewImage'+data[i].id+'"> <input type="hidden" name="imagens[]" value="'+data[i].id+'"> <img class="p-3 w-100" src="{{asset("storage/app")}}/'+data[i].caminho+'" style="height: 180px;"><a href="javascript:void(0)" onclick="removeImagem('+data[i].id+')" class="btn rounded-circle m-n2">x</a> </div>');
                        } 
                       $('#addFotoGaleria').val('');   
                    }
                });
            }
        });

        // Cadastrando as categorias
        $("#addCategoria").on('click', function(){
            $(this).attr('disabled', 'disabled');
            var data = $("#listaCategorias option:selected");

            if(data.val()){ 
                $.ajax({
                    url: '../categorias/detalhes/'+data.val(),
                    type: 'GET',
                    success: function(data){ 
                        // Removendo do select
                        $('select').formSelect('destroy');
                        $('#listaCategorias option:selected').remove();
                        $('select').formSelect();
                        $(".notCategorias").remove();
                        //// Inserindo dados na tabela
                        $("#tableCategoria tbody").append('<tr> <td class="name"> '+data.nome+' <input type="hidden" name="categorias[]" value="'+data.id+'"> </td> <td> <div class="text-center"> <a href="javascript:void(0)" onclick="removeCategoria(this)" class="btn btn-danger rounded-circle shadow-none">X</a> </div> </td> </tr>');
                        $('#addCategoria').removeAttr('disabled');
                    }
                });
            }
        });

        // Cadastrando as variações
        $("#addVariacoes").on('click', function(){
            $(this).attr('disabled', 'disabled');
            var data = $("#listaVariacoes option:selected");

            if(data.val()){ 
                $.ajax({
                    url: '../variacoes/detalhes/'+data.val(),
                    type: 'GET',
                    success: function(data){ 
                        // Removendo do select
                        $('select').formSelect('destroy');
                        $('#listaVariacoes option:selected').remove();
                        $('select').formSelect();
                        $(".notVariacoes").remove();
                        //// Inserindo dados na tabela
                        $("#tableVariacoes tbody").append('<tr> <td class="name"> '+data.nome+' <input type="hidden" name="variacoes[]" value="'+data.id+'"> </td> <td> '+data.valor+' </td> <td> <div class="text-center"> <a href="javascript:void(0)" onclick="removeVariacao(this)" class="btn btn-danger rounded-circle shadow-none">X</a> </div> </td> </tr>');
                        $('#addVariacoes').removeAttr('disabled');                        
                    }
                });
            }
        });

        // Mascaras
        $('.currency').mask('000.000.000.000.000,00', {reverse: true});
        $('.cod_ean').mask('0000000000000');
        $('.medida').mask('00000.00', {reverse: true});
        $('.cod_sku').mask('AAAAAAAAAA', {'translation': {
            A: {pattern: /[A-Za-z0-9]/},
        }});

        // Tipo de produto
        $('#variante1').on('click', function(){
            $('#variante2').removeClass('border-primary');
            $('#variante2 input').removeAttr('checked');
            $('#card-3').addClass('d-none');
            $(this).addClass('border-primary');
            $('#variante1 input').attr('checked', 'checked');
        });
        $('#variante2').on('click', function(){
            $('#variante1').removeClass('border-primary');
            $('#variante1 input').removeAttr('checked');
            $('#card-3').removeClass('d-none');
            $(this).addClass('border-primary');
            $('#variante2 input').attr('checked', 'checked');
        });

        // Gerando SKU
        $('.gerar').on('click', function(){
            $('.cod_sku').val(Math.random().toString(36).substring(3, 13).toUpperCase());
        });

        // Adicionando as marcas
        $('#produtos-marcas #formMarcas').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url: '{{ route("salvar.marcas") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#produtos-marcas #formMarcas').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('#produtos-marcas #formMarcas').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Marca adicionada com sucesso!</label></div>');
                    $('#listaMarcas').formSelect('destroy');
                    $(data).each(function(index, element){
                        $('#listaMarcas').append('<option value="'+element.id+'">'+element.nome+'</option>');
                    });
                    $('#listaMarcas').formSelect();

                    setTimeout(function(){
                        $('#produtos-marcas #formMarcas').each (function(){
                            this.reset();
                        });
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#produtos-marcas #formMarcas').removeClass('d-none');
                        $('#produtos-marcas').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#produtos-marcas #formMarcas').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#produtos-marca #err').html(data.responseText);
                        }else{
                            $('#produtos-marca #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#produtos-marca #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                $('input[name="'+key+'"]').addClass('border border-danger');
                            });
                        }
                    }, 800);
                }
            });
        });

        // Adicionando as categorias
        $('#produtos-categorias #formCategorias').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("salvar.categorias") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#produtos-categorias #formCategorias').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('#produtos-categorias #formCategorias').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Categoria adicionada com sucesso!</label></div>');

                    $('#listaCategorias').formSelect('destroy');
                    $(data).each(function(index, element){
                        $('#listaCategorias').append('<option value="'+element.id+'">'+element.nome+'</option>');
                    });
                    $('#listaCategorias').formSelect();

                    setTimeout(function(){
                        $('#produtos-categorias #formCategorias').each (function(){
                            this.reset();
                        });
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#produtos-categorias #formCategorias').removeClass('d-none');
                        $('#produtos-categorias').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#produtos-categorias #formCategorias').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#produtos-categorias #err').html(data.responseText);
                        }else{
                            $('#produtos-categorias #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#produtos-categorias #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
                                $('input[name="'+key+'"]').addClass('border border-danger');
                            });
                        }
                    }, 800);
                }
            });
        });

        // Adicionando as variantes
        $('#produtos-variantes #formVariante').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("salvar.variacoes") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#produtos-variantes #formVariante').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Variação adicionada com sucesso!</label></div>');

                    $('#listaVariacoes').formSelect('destroy');
                    $(data).each(function(index, element){
                        $('#listaVariacoes').append('<option value="'+element.id+'">'+element.nome+'</option>');
                    });
                    $('#listaVariacoes').formSelect();

                    setTimeout(function(){
                        $('#produtos-variantes #formVariante').each (function(){
                            this.reset();
                        });
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#produtos-variantes #formVariante').removeClass('d-none');
                        $('#produtos-variantes').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#produtos-variantes #formVariante').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#produtos-variantes #err').html(data.responseText);
                        }else{
                            $('#produtos-variantes #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#produtos-variantes #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
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
