@extends('admin.layouts.index')

@section('title')
Sliders
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Sliders</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></div>
                    <div class="breadcrumb-item active">Sliders</div>
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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('salvar.slider.marketplace') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($slider[0]))
                            @foreach($slider as $count => $slide)
                                <div class="card" id="card-{{$slide->id}}">
                                    <div class="card-header py-0">
                                        <h5 class="section-title">Slider {{$count+1}}</h5>
                                        <a href="javascript:void(0)" onclick="removeCard('{{$slide->id}}')" class="remove badge badge-danger ml-2 mt-2" title="Deletar o slider">
                                            <small>Remover</small>
                                        </a>
                                        <a href="javascript:void(0)" onclick="mostrarCard('{{$slide->id}}')" class="mostrar ml-auto">
                                            <i class="mdi mdi-chevron-down mdi-24px"></i>
                                        </a>
                                    </div>
                                    <div class="card-body row col-12" style="display: none">
                                        <input type="hidden" name="id[]" value="{{$slide->id}}">
                                        <div class="col-7">
                                            <div class="form-group col-11">
                                                <label>Título</label>
                                                <input type="text" name="title[]" class="form-control" placeholder="Seu título da publicação" onkeyup="$('.title{{$slide->id}}').html(this.value)" value="{{$slide->title}}">
                                            </div>
                                            <div class="form-group col-11">
                                                <label>Texto</label>
                                                <input type="text" name="text[]" class="form-control" placeholder="Sua mensagem que será mostrada" onkeyup="$('.text{{$slide->id}}').html(this.value)" value="{{$slide->text}}">
                                            </div>
                                            <div class="row col-12 mb-0">
                                                <div class="form-group col-5">
                                                    <label>Texto do botão</label>
                                                    <input type="text" name="text_button[]" class="form-control" onkeyup="$('.tagName{{$slide->id}}').html(this.value)" value="{{$slide->text_button}}" placeholder="Veja mais">
                                                </div>
                                                <div class="form-group col-5">
                                                    <label>TAG name <i class="text-danger">*</i></label>
                                                    <input type="text" name="tagName[]" value="{{$slide->tagName}}" class="form-control" onkeyup="$('.tagName{{$slide->id}}').attr('href', this.value)"  placeholder="novidades" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Escurecer</label>
                                                <input type="number" step="0.01" name="escurecer[]" value="{{$slide->escurecer}}" class="form-control" onkeyup="$('#PreviewImage{{$slide->id}}').attr('style', 'filter: brightness('+this.value+'); height: 30em;')" placeholder="0.5">
                                            </div>
                                            <div class="form-group col-10">
                                                <label class="mb-0">Selecione sua imagem <i class="text-danger">*</i></label>
                                                <br>
                                                <small>Aceitamos .png, .jpg ou .svg</small>
                                                <div class="mt-2">
                                                    <div class="file-field input-field">
                                                        <div class="btn py-0">
                                                            <span>Imagem</span>
                                                            <input type="file" accept="image/*" name="id_imagem[]" onchange="imageBackground('{{$slide->id}}', this)">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text" placeholder="Selecione sua imagem" value="{{$slide->RelationImagens->caminho}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 p-0 row align-items-center ml-n4">
                                            <div class="text-center w-100 text-white" style="z-index: 2">
                                                <h6 class="title{{$slide->id}}">{{$slide->title}}</h6>
                                                <h3 class="text{{$slide->id}} text-uppercase pb-3 pt-1 px-3">{{$slide->text}}</h3>
                                                <a href="{{$slide->tagName}}" target="_blank" class="tagName{{$slide->id}} btn btn-light text-uppercase shadow-none" style="border-radius: 23px">{{$slide->text_button}}</a>
                                            </div>
                                            <div class="position-absolute text-center">
                                                <img class="w-100 rounded" id="PreviewImage{{$slide->id}}" src="{{( isset($slide->RelationImagens) ? asset('storage/app').'/'.$slide->RelationImagens->caminho : asset('public/admin/img/system/product.png')) }}" style="filter: brightness({{$slide->escurecer}}); height: 30em;">
                                                <div class="mt-2">
                                                    <small class="font-weight-bold">Tamanho de imagem recomendado: 1920x400</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="col-12 alert alert-light">
                                    <label class="mb-0 text-dark">Você não possui nenhum slider cadastrado.</label>
                                </div>
                            </div>
                        @endif

                        <div class="newSlider"></div>

                        <div class="col-2">
                            <a href="javascript:void(0)" id="newSlider" class="d-flex m-auto btn waves-effect waves-light justify-content-center">
                                <i class="mdi mdi-plus pr-1"></i> 
                                <span>Novo slider</span>
                            </a>
                        </div>

                        <hr>

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('exibir.instituicoes') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
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
<div class="d-none" id="card-slider">
    <div class="card">
        <div class="card-header py-0">
            <h5 class="section-title">Slider</h5>
            <a href="javascript:void(0)" onclick="" class="remove badge badge-danger ml-2 mt-2" title="Deletar o slider">
                <small>Remover</small>
            </a>
            <a href="javascript:void(0)" onclick="" class="mostrar ml-auto">
                <i class="mdi mdi-chevron-down mdi-24px"></i>
            </a>
        </div>
        <div class="card-body row col-12">
            <div class="col-7">
                <div class="form-group col-11">
                    <label>Título</label>
                    <input type="text" name="title[]" class="title form-control" placeholder="Seu título da publicação">
                </div>
                <div class="form-group col-11">
                    <label>Texto</label>
                    <input type="text" name="text[]" class="text form-control" placeholder="Sua mensagem que será mostrada">
                </div>
                <div class="row col-12 mb-0">
                    <div class="form-group col-5">
                        <label>Texto do botão</label>
                        <input type="text" name="text_button[]" class="text_button form-control" placeholder="Veja mais">
                    </div>
                    <div class="form-group col-5">
                        <label>TAG name <i class="text-danger">*</i></label>
                        <input type="text" name="tagName[]" class="tagName form-control" placeholder="novidades" required>
                    </div>
                </div>
                 <div class="form-group col-5">
                    <label>Escurecer</label>
                    <input type="number" step="0.01" name="escurecer[]" placeholder="0.5" max="1" min="0" class="escurecer form-control">
                </div>
                <div class="form-group col-10">
                    <label class="mb-0">Selecione sua imagem <i class="text-danger">*</i></label>
                    <br>
                    <small>Aceitamos .png, .jpg ou .svg</small>
                    <div class="mt-2">
                        <div class="file-field input-field">
                            <div class="btn py-0">
                                <span>Imagem</span>
                                <input type="file" accept="image/*" name="id_imagem[]" class="id_imagem">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Selecione sua imagem">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 p-0 m-auto row align-items-center">
                <div class="text-center w-100 text-white" style="z-index: 2">
                    <h6 class="titleIMG"></h6>
                    <h3 class="textIMG text-uppercase pb-3 pt-1 px-3"></h3>
                    <a href="#" target="_blank" class="tagNameIMG btn btn-light text-uppercase shadow-none" style="border-radius: 23px"></a>
                </div>
                <div class="position-absolute text-center">
                    <img class="w-100" id="PreviewImage" src="{{asset('public/admin/img/system/fundo.png')}}" style="filter: brightness(0.8); height: 30em;">
                    <div class="mt-2">
                        <small class="font-weight-bold">Tamanho de imagem recomendado: 1920x400</small>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection

@section('support')
<script type="text/javascript">
    function removeCard(id){
        swal({
          title: "Tem certeza que deseja remover o slider?",
          icon: "warning",
          buttons: ["Cancelar", "Remover"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "slider/remover/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    $('#card-'+id).remove();
                }
            });
            swal("Slider removido com sucesso!", {
              icon: "success",
            });
          } else {
            swal.close();
          }
        });
    }

    function mostrarCard(id){
        if($('#card-'+id).children('.card-header').children('.mostrar').children('i').hasClass('mdi-chevron-up')){
            $('#card-'+id).children('.card-body').fadeOut();
            $('#card-'+id).children('.card-header').children('.mostrar').html('<i class="mdi mdi-chevron-down mdi-24px"></i>');
        }else{
            $('#card-'+id).children('.card-body').fadeIn('slow');
            $('#card-'+id).children('.card-header').children('.mostrar').html('<i class="mdi mdi-chevron-up mdi-24px"></i>');
        } 
    }

    // Carregamento experimentar da imagem
    function imageBackground(id, input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (oFREvent){
                $('#PreviewImage'+id).attr('src', oFREvent.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function (){
        var qtd = "{{count($slider)}}";
        var count = "{{$slider->last()->id}}";
        $('#newSlider').on('click', function(e){3
            qtd++;
            count++;
            $('.newSlider').append($('#card-slider').html());
            $('.newSlider .card:last-child').attr('id', 'card-'+count);
            $('.newSlider .card:last-child .section-title').html('Slider '+qtd);
            $('.newSlider .card:last-child .card-header .remove').attr('onclick', "$('.newSlider #card-"+count+"').remove();");
            $('.newSlider .card:last-child .card-header .mostrar').attr('onclick', 'mostrarCard('+count+')');
            $('.newSlider .card:last-child .card-body .title').attr('onkeyup', "$('.title"+count+"').html(this.value)");
            $('.newSlider .card:last-child .card-body .text').attr('onkeyup', "$('.text"+count+"').html(this.value)");
            $('.newSlider .card:last-child .card-body .text_button').attr('onkeyup', "$('.tagName"+count+"').html(this.value)");
            $('.newSlider .card:last-child .card-body .tagName').attr('onkeyup', "$('.tagName"+count+"').attr('href', this.value)");
            $('.newSlider .card:last-child .card-body .escurecer').attr('onkeyup', "$('#PreviewImage"+count+"').attr('style', 'filter: brightness('+this.value+');height: 30em;')");
            $('.newSlider .card:last-child .card-body .id_imagem').attr('onchange', "imageBackground('"+count+"', this)");
            $('.newSlider .card:last-child .card-body .titleIMG').addClass('title'+count);
            $('.newSlider .card:last-child .card-body .textIMG').addClass('text'+count);
            $('.newSlider .card:last-child .card-body .tagNameIMG').addClass('tagName'+count);
            $('.newSlider .card:last-child .card-body #PreviewImage').attr('id', 'PreviewImage'+count);
        });
    });
</script>
@endsection