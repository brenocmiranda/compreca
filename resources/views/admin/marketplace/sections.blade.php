@extends('admin.layouts.index')

@section('title')
Sections
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Sections</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></div>
                    <div class="breadcrumb-item active">Sections</div>
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
                    <ul class="nav nav-pills mx-3 mb-3" id="myTab1" role="tablist">
                        <li class="nav-item">
                            <button class="btn d-flex align-items-center m-1" id="newTabButton">
                                <i class="mdi mdi-plus pr-2"></i>
                                <span>Nova section</span> 
                            </button>
                        </li>
                        @foreach($sections->sortBy('section') as $key => $dados)
                        <li class="nav-item">
                            <a class="nav-link border m-1 d-flex align-items-center" id="tab-section{{$dados->id}}" data-toggle="tab" href="#section{{$dados->id}}" role="tab" aria-controls="{{$dados->id}}" aria-selected="true">
                                <span>Section {{$key+1}}</span> 
                                <i class="mdi mdi-chevron-up pl-2"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('salvar.sections.marketplace') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="myTab2">
                            @foreach($sections as $dados)
                            <div class="tab-pane fade" id="section{{$dados->id}}" role="tabpanel" aria-labelledby="tab-section{{$dados->id}}">
                                <div class="card">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Informações básicas</h5>
                                        <a href="javascript:void(0)" onclick="removeCard('{{$dados->id}}')" class="badge badge-danger ml-auto" title="Deletar a section">
                                            <span>Remover</span>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="id[]" value="{{$dados->id}}">
                                                <div class="form-group col-3">
                                                    <label class="mb-0">Localização<i class="text-danger">*</i></label>
                                                    <input type="number" name="section[]" class="form-control" placeholder="1" value="{{$dados->section}}" required>
                                                </div>
                                                <div class="form-group col-7">
                                                    <label class="mb-0">Titulo <i class="text-danger">*</i></label>
                                                    <input type="text" name="title[]" class="form-control" placeholder="Categorias em destaque" value="{{$dados->title}}" required>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="mb-0">Fundo da seção <i class="text-danger">*</i></label>
                                                    <div class="input-group colorpickerinput">               
                                                        <div class="input-group-append">
                                                            <input type="text" name="background[]" class="form-control" placeholder="#fff" value="{{$dados->background}}" required>
                                                            <div class="input-group-text p-0 border-0">
                                                                <i class="p-3 rounded m-1"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="custom-switch p-0">
                                                        <input type="checkbox" name="containerCheck" class="containerCheck custom-switch-input" {{($dados->container == 1 ? 'checked' : '')}}>
                                                        <input type="hidden" class="container" name="container[]" value="{{($dados->container == 1 ? 'on' : 'off')}}">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Container</span>
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="custom-switch p-0">
                                                        <input type="checkbox" name="carouselCheck" class="carouselCheck custom-switch-input" {{($dados->carousel == 1 ? 'checked' : '')}}>
                                                        <input type="hidden" class="carousel" name="carousel[]" value="{{($dados->carousel == 1 ? 'on' : 'off')}}">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Slider</span>
                                                    </label>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="mb-0">Style CSS <i class="text-danger">*</i></label>
                                                    <textarea name="style[]" class="form-control" placeholder="Digite aqui suas classes">{{$dados->style}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Cards</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row col-12 m-0 p-0">
                                                    <div class="form-group col-3"> 
                                                        <label class="mb-0">Largura <i class="text-danger">*</i></label>
                                                        <div class="input-group-append">
                                                            <input type="number" name="width_card[]" class="form-control" placeholder="100" min="1" value="{{$dados->width_card}}" requerid> 
                                                            <div class="input-group-text p-0 border-0">
                                                                px
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group col-3"> 
                                                        <label class="mb-0">Altura <i class="text-danger">*</i></label> 
                                                        <div class="input-group-append">
                                                            <input type="number" name="height_card[]" class="form-control" placeholder="200" min="1" value="{{$dados->height_card}}" requerid> 
                                                            <div class="input-group-text p-0 border-0">
                                                                px
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </div> 
                                                <div class="form-group col-2"> 
                                                    <label class="mb-0">Quantidade por Slider</label> 
                                                    <input type="number" name="qtdCarousel[]" class="form-control" placeholder="4"  value="{{$dados->qtdCarousel}}"> 
                                                </div> 
                                                <div class="form-group col-5">
                                                    <label class="mb-0">Tipo de seção <i class="text-danger">*</i></label>
                                                    <select class="type" name="type[]" onchange="listarOpcoes(this, '{{$dados->id}}')" required>
                                                        <option>Selecione</option>
                                                        <option value="categorias" {{($dados->type == 'categorias' ? 'selected' : '')}}>Categorias</option>
                                                        <option value="produtos" {{($dados->type == 'produtos' ? 'selected' : '')}}>Produtos</option>
                                                        <option value="marcas" {{($dados->type == 'marcas' ? 'selected' : '')}}>Marcas</option>
                                                        <option value="lojas" {{($dados->type == 'lojas' ? 'selected' : '')}}>Lojas</option>
                                                        <option value="instituicoes" {{($dados->type == 'instituicoes' ? 'selected' : '')}}>Instituições</option>
                                                        <option value="outros" {{($dados->type == 'outros' ? 'selected' : '')}}>Outros</option>
                                                    </select>
                                                </div>

                                                <div class="col-11 mx-auto">
                                                    <input type="hidden" name="qtd_card[]" class="qtd_card" value="{{$dados->RelationCards->count()}}">
                                                    <div class="cards{{$dados->id}} cards">
                                                        
                                                    </div>
                                                </div>


                                                <div class="form-group col-12">
                                                    <label class="mb-0">Style CSS <i class="text-danger">*</i></label>
                                                    <textarea name="style_card[]" class="form-control" placeholder="Digite aqui suas classes">{{$dados->style_card}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-12 mb-5 text-right">
                            <a href="#" onclick="location.reload()" class="btn btn-secondary col-2 mx-1">Cancelar</a>
                            <button class="btn waves-effect waves-light col-2 mx-1">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('modal')
<div id="newTab" class="d-none">
    <li class="nav-item">
        <a class="nav-link border m-1 d-flex align-items-center" id="tab-section" data-toggle="tab" href="#section" role="tab" aria-controls="" aria-selected="true">
            <span>Section</span> 
            <i class="mdi mdi-chevron-up pl-2"></i>
        </a>
    </li>
</div>
<div id="newSection" class="d-none">
    <div class="tab-pane fade" id="section" role="tabpanel" aria-labelledby="tab-section">
        <div class="card">
            <div class="card-header py-0">
                <h5 class="section-title">Informações básicas</h5>
                <a href="javascript:void(0)" onclick="removeCardNew(this)" class="badge badge-danger ml-auto" title="Deletar a section">
                    <span>Remover</span>
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group col-3">
                            <label class="mb-0">Localização<i class="text-danger">*</i></label>
                            <input type="number" name="section[]" class="form-control" placeholder="1" required>
                        </div>
                        <div class="form-group col-7">
                            <label class="mb-0">Titulo <i class="text-danger">*</i></label>
                            <input type="text" name="title[]" class="form-control" placeholder="Categorias em destaque" required>
                        </div>
                        <div class="form-group col-3">
                            <label class="mb-0">Fundo da seção <i class="text-danger">*</i></label>
                            <div class="input-group colorpickerinput">                         
                                <div class="input-group-append">
                                    <input type="text" name="background[]" class="form-control" placeholder="#ffffff" required>
                                    <div class="input-group-text p-0 border-0">
                                        <i class="p-3 rounded m-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label class="custom-switch p-0">
                                <input type="checkbox" name="containerCheck" class="containerCheck custom-switch-input" checked>
                                <input type="hidden" class="container" name="container[]" value="on">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Container</span>
                            </label>
                        </div>
                        <div class="form-group col-3">
                            <label class="custom-switch p-0">
                                <input type="checkbox" name="carouselCheck" class="carouselCheck custom-switch-input">
                                <input type="hidden" class="carousel" name="carousel[]">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Slider</span>
                            </label>
                        </div>
                        <div class="form-group col-12">
                            <label class="mb-0">Style CSS</label>
                            <textarea name="style[]" class="form-control" placeholder="Digite aqui suas classes"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header py-0">
                <h5 class="section-title">Cards</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row col-12 m-0 p-0">
                            <div class="form-group col-3"> 
                                <label class="mb-0">Largura <i class="text-danger">*</i></label>
                                <div class="input-group-append">
                                    <input type="number" name="width_card[]" class="form-control" placeholder="100" min="1" requerid> 
                                    <div class="input-group-text p-0 border-0">
                                        px
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group col-3"> 
                                <label class="mb-0">Altura <i class="text-danger">*</i></label> 
                                <div class="input-group-append">
                                    <input type="number" name="height_card[]" class="form-control" placeholder="200" min="1"> 
                                    <div class="input-group-text p-0 border-0">
                                        px
                                    </div>
                                </div>
                            </div>   
                        </div> 
                        <div class="form-group col-2"> 
                            <label class="mb-0"> Quantidade por Slider <i class="text-danger">*</i></label> 
                            <input type="number" name="qtd_carousel[]" class="form-control" placeholder="4" min="1"> 
                        </div> 
                        <div class="form-group col-5">
                            <label class="mb-0">Tipo de seção <i class="text-danger">*</i></label>
                            <select class="type" name="type[]" onchange="listarOpcoes(this)" required>
                                <option>Selecione</option>
                                <option value="categorias">Categorias</option>
                                <option value="produtos">Produtos</option>
                                <option value="marcas">Marcas</option>
                                <option value="lojas">Lojas</option>
                                <option value="instituicoes">Instituições</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>

                        <div class="col-11 mx-auto">
                            <input type="hidden" name="qtd_card[]" class="qtd_card" value="">
                            <div class="cards">
                                
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label class="mb-0">Style CSS</label>
                            <textarea name="style_card[]" class="form-control" placeholder="Digite aqui suas classes">{{$dados->style}}</textarea>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('support')
<script type="text/javascript">
    // Deletando as sections
    function removeCard(id){
        swal({
          title: "Tem certeza que deseja remover?",
          icon: "warning",
          buttons: ["Cancelar", "Remover"],
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "sections/remover/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    $('#myTab2 .active').fadeOut().remove();
                    $('#myTab1 li a.active').remove();
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
    // Deletando as sections news
    function removeCardNew(input){
        swal({
          title: "Tem certeza que deseja remover?",
          icon: "warning",
          buttons: ["Cancelar", "Remover"],
          dangerMode: true,
          })
            .then((willDelete) => {
              if (willDelete) {
                $('#myTab1 li a.active').remove();
                $('#myTab2 .tab-pane:last-child').remove();
                swal("Informações alteradas com sucesso!", {
                  icon: "success",
              });
            } else {
                swal.close();
            }
        });
    } 
    // Retorno de cards do controller
    function listarOpcoes(input, id_section){
        $.ajax({
            url: "sections/opcoes/"+input.value+"/"+id_section,
            type: 'GET',
            processData: true,
            "async": true,
            "crossDomain": true,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data){
                var section = $('#myTab1 li a.active').attr('href');
                $(section).find('.cards').removeClass('slick-initialized slick-slider');
                $(section).find('.cards').html('');
                $.each(data, function(){
                    $(section).find('.cards').append(data.card);
                });
                $(section).find('.cards').slick({
                    infinite: false,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    dots: true,
                    focusOnChange: true,
                });
            }
        });   
    }
    // Alterando quantidade por card
    function change(input){
        var value = parseInt($(input).parents('.cards').prev('input').val());
        if($(input).is(':checked')){
            $(input).parents('.cards').prev('input').val(value + 1);  
        }else{
            $(input).parents('.cards').prev('input').val(value - 1);
       }
    }

    $(document).ready(function (){
        var lastSection = '{{$sections->last()->id+1}}';
        var countSection = '{{count($sections)+1}}';

        // Inserindo uma nova seção
        $('#newTabButton').on('click', function(e){
            // Nova Tab
            $('#myTab1').append($('#newTab').html());
            $('#myTab1 .nav-item:last-child a').attr('id', 'tab-section'+lastSection);
            $('#myTab1 .nav-item:last-child a').attr('href', '#section'+lastSection);
            $('#myTab1 .nav-item:last-child a').attr('aria-controls', lastSection);
            $('#myTab1 .nav-item:last-child a span').html('Section '+countSection);
            // Nova Section
            $('#newSection .type').formSelect('destroy');
            $('#myTab2').append($('#newSection').html());
            $('#myTab2 .tab-pane:last-child').attr('id', 'section'+lastSection);
            $('#myTab2 .tab-pane:last-child').attr('aria-labelledby', 'tab-section'+lastSection);
            $('#myTab2 .tab-pane:last-child .card:last-child .cards').addClass('cards'+lastSection);
            $('#myTab2 .tab-pane:last-child .type').formSelect();
            $('#myTab1 li:last-child a').tab('show');
            lastSection++;
            countSection++;
        });

        // Alterando input checkbox de container
        $('.containerCheck').on('change', function(){
            var section = $('#myTab1 li a.active').attr('href');
            if($(section).find('.container').val() == 'on'){
                $(section).find('.container').val('off');
            }else{
                $(section).find('.container').val('on');
            }
        });

        // Alterando input checkbox de carousel
        $('.carouselCheck').on('change', function(){
            var section = $('#myTab1 li a.active').attr('href');
            if($(section).find('.carousel').val() == 'on'){
                $(section).find('.carousel').val('off');
            }else{
                $(section).find('.carousel').val('on');
            }
        });

        // Carregando itens ao troca de aba
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            $(this).children('i').removeClass('mdi-chevron-up');
            $(this).children('i').addClass('mdi-chevron-down');
            $(e.relatedTarget).children('i').removeClass('mdi-chevron-down');
            $(e.relatedTarget).children('i').addClass('mdi-chevron-up');
            var section = $(this).attr('href');
            $.ajax({
                url: "sections/opcoes/"+$(section).find('.type').val()+'/'+section.replace('#section', ''),
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    $(section).find('.cards').removeClass('slick-initialized slick-slider');
                    $(section).find('.cards').html('');
                    $.each(data, function(){
                        $(section).find('.cards').append(data.card);
                    });
                    $(section).find('.cards').slick({
                        infinite: false,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        dots: true,
                        focusOnChange: true,
                    });
                }
            });
        });
    });
</script>
@endsection
