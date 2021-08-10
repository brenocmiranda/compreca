@extends('admin.layouts.index')

@section('title')
Geral
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Geral</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Plataforma</a></div>
                    <div class="breadcrumb-item active"><a href="{{route('plataforma.geral')}}">Geral</a></div>
                </div>
            </div>
        </div>

        <div id="confirm"></div>

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
                    <form method="POST" action="{{ route('plataforma.salvar.geral', $geral->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card" id="card-1">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-6">
                                    <label>Nome da plataforma <i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="CompreCá" value="{{$geral->nome}}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Razão Social <i class="text-danger">*</i></label>
                                    <input type="text" name="razao_social" class="form-control" placeholder="CompreCá" value="{{$geral->razao_social}}" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Documento </label>
                                    <input type="text" name="cnpj" id="documento" class="form-control" value="{{$geral->cnpj}}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Frase de descrição</label>
                                    <input type="text" name="frase_descricao" class="form-control" placeholder="Nunca foi tão fácil comprar e receber em instantes" value="{{$geral->frase_descricao}}">
                                </div>
                                <div class="form-group col-12">
                                    <label>Descrição da plataforma</label>
                                    <textarea class="summernote" name="descricao">{{$geral->descricao}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="card-2">
                            <div class="card-header py-0">
                                <h5 class="section-title">Localização</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-3">
                                    <label>CEP <i class="text-danger">*</i></label>
                                    <input type="text" name="cep" id="cep" class="form-control" placeholder="39270-000" value="{{$geral->cep}}" required>
                                    <small class="error"></small>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group col-8 p-02">
                                        <label>Endereço <i class="text-danger">*</i></label>
                                        <input type="text" name="endereco" class="form-control" placeholder="Rua da Antonio Nascimento" value="{{$geral->endereco}}" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>
                                    <div class="form-group col-3 p-0">
                                        <label>Numero <i class="text-danger">*</i></label>
                                        <input type="number" name="numero" class="form-control" placeholder="268" value="{{$geral->numero}}" required>
                                    </div>
                                </div>
                                <div class="form-group col-10">
                                    <label>Complemento</label>
                                    <input type="text" name="complemento" placeholder="Ex.: Apt., Loja 1, Casa" class="form-control" value="{{$geral->complemento}}" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="form-group col-5">
                                    <label>Bairro <i class="text-danger">*</i></label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Centro" value="{{$geral->bairro}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="bairro1" id="bairro1" value="{{$geral->bairro}}">
                                </div>
                                <div class="form-group col-4">
                                    <label>Cidade <i class="text-danger">*</i></label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Pirapora" value="{{$geral->cidade}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="cidade1" id="cidade1" value="{{$geral->cidade}}">
                                </div>
                                <div class="form-group col-3">
                                    <label>Estado <i class="text-danger">*</i></label>
                                    <input type="text" name="estado" id="estado" class="form-control" placeholder="Minas Gerais" value="{{$geral->estado}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="estado1" id="estado1" value="{{$geral->estado}}">
                                </div>                                   
                            </div>
                        </div>

                        <div class="card" id="card-3">
                            <div class="card-header py-0">
                                <h5 class="section-title">Imagens</h5>
                            </div>
                            <div class="card-body row mx-auto col-12">
                              <div class="form-group col-4">
                                  <div class="text-center">
                                      <label class="col-12 row font-weight-bold text-dark">Selecione sua logomarca  <i class="text-danger">*</i></label>
                                      <div id="PreviewImage" class="image-preview w-100" style="height: 300px; background: url('{{ (isset($geral->RelationLogomarca) ? asset('storage/app/'.$geral->RelationLogomarca->caminho.'?'.rand()) : '') }}') no-repeat; background-size: contain; background-position: center;">
                                          <label for="logomarca" id="image-label" class="text-white rounded">Selecione</label>
                                          <input type="file" accept="image/*" name="logomarca" id="logomarca" onchange="image(this);">
                                      </div> 
                                      <small class="my-2">Aceitamos .png, .jpg ou .svg</small>
                                  </div>
                              </div>
                              <div class="form-group col-4">
                                  <div class="text-center">
                                      <label class="col-12 row font-weight-bold text-dark">Selecione seu icone <i class="text-danger">*</i></label>
                                      <div id="PreviewImage" class="image-preview w-100" style="height: 300px; background: url('{{ (isset($geral->RelationIcone) ? asset('storage/app/'.$geral->RelationIcone->caminho.'?'.rand()) : '') }}') no-repeat; background-size: contain; background-position: center;">
                                          <label for="icone" id="image-label" class="text-white rounded">Selecione</label>
                                          <input type="file" accept="image/*" name="icone" id="icone" onchange="image(this);">
                                      </div> 
                                      <small class="my-2">Aceitamos .png, .jpg ou .svg</small>
                                  </div>
                              </div>
                         
                            </div>
                        </div>

                        <div class="card" id="card-4">
                            <div class="card-header py-0">
                                <h5 class="section-title">Contatos</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-8">
                                    <label>Telefone de contato <i class="text-danger">*</i></label>
                                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(38) 3245-6653" value="{{$geral->telefone}}" required>
                                </div>
                                <div class="form-group col-8">
                                    <label>WhatsApp</label>
                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="(38) 991680335" value="{{$geral->whatsapp}}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>E-mail de contato <i class="text-danger">*</i></label>
                                    <input type="text" name="email_contato" class="form-control" placeholder="contato@compreca.com" value="{{$geral->email_contato}}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>E-mail de suporte  <i class="text-danger">*</i></label>
                                    <input type="text" name="email_suporte" class="form-control" placeholder="suporte@compreca.com" value="{{$geral->email_suporte}}" required>
                                </div>
                                <div class="form-group col-8">
                                    <label>URL do Instagram</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.instagram.com/</span>
                                        <input type="text" name="url_instagram" class="form-control mx-2" placeholder="compreca" value="{{$geral->url_instagram}}">
                                    </div>
                                </div>
                                <div class="form-group col-8">
                                    <label>URL do Facebook</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.facebook.com/</span>
                                        <input type="text" name="url_facebook" class="form-control mx-2" placeholder="compreca" value="{{$geral->url_facebook}}">
                                    </div>
                                </div>
                                <div class="form-group col-8">
                                    <label>URL do Youtube</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.youtube.com/channel/</span>
                                        <input type="text" name="url_youtube" class="form-control mx-2 col-4" placeholder="compreca" value="{{$geral->url_youtube}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>  

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('plataforma.geral') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
                            <button class="btn waves-effect waves-light col-2 mx-1">Salvar</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('support')
<script type="text/javascript">
    $(document).ready(function (){
    // Mascaras
        $('#documento').mask('00.000.000/0000-00');
        $('#telefone').mask('(00) 00000-0000');
        $('#whatsapp').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
        
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {
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
                                $("#cidade").attr('disabled', 'disabled');
                                $("#cidade").val(dados.localidade.toUpperCase());
                                $("#cidade1").val(dados.localidade.toUpperCase());
                            }else{
                                $("#cidade").removeAttr('disabled');
                            }
                            if(dados.uf){
                                $("#estado").attr('disabled', 'disabled');
                                $("#estado").val(dados.uf.toUpperCase());
                                $("#estado1").val(dados.uf.toUpperCase());
                            }else{
                                $("#estado").removeAttr('disabled');
                            }
                            if(dados.bairro){
                                $("#bairro").attr('disabled', 'disabled');
                                $("#bairro").val(dados.bairro.toUpperCase());
                                $("#bairro1").val(dados.bairro.toUpperCase());
                            }else{
                                $("#bairro").removeAttr('disabled');
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
                $("#cidade").val('');
                $("#estado").val('');
                $("#cidade").val('');
                $("#cep").val('');
                $(".error").html('');
            }
        });
    });
</script>
@endsection