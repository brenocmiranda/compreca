@extends('admin.layouts.index')

@section('title')
Editar instituição
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Editar instituição</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.instituicoes')}}">Usuários</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.instituicoes')}}">Instituições</a></div>
                    <div class="breadcrumb-item active">Editar</div>
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
                    <form method="POST" action="{{ route('editando.instituicoes', $instituicoes->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card" id="card-1">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    <label class="custom-switch px-0">
                                        <input type="checkbox" name="status" class="custom-switch-input" {{($instituicoes->status == 1 ? ' checked' : '')}}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"><b>Ativo</b></span>
                                    </label>
                                </div>
                                <div class="form-group col-8">
                                    <label>Nome da instituição <small>(Visível ao público)</small><i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="CompreCá" value="{{$instituicoes->nome}}" required>
                                </div>
                                <div class="form-group col-10">
                                    <label>Razão Social<i class="text-danger">*</i></label>
                                    <input type="text" name="razao_social" class="form-control" placeholder="CompreCá MarketPlace - ME" value="{{$instituicoes->razao_social}}" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Documento <small>(CNPJ/CPF)</small> <i class="text-danger">*</i></label>
                                    <input type="text" name="documento" id="documento" class="form-control" value="{{$instituicoes->documento}}" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Descrição da loja</label>
                                    <textarea class="summernote" name="descricao">{{$instituicoes->descricao}}</textarea>
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
                                    <input type="text" name="cep" id="cep" class="form-control" placeholder="39270-000" value="{{$instituicoes->cep}}" required>
                                    <small class="error"></small>
                                </div>
                                <div class="row col-12 mb-0">
                                    <div class="form-group col-8">
                                        <label>Endereço <i class="text-danger">*</i></label>
                                        <input type="text" name="endereco" class="form-control" placeholder="Rua da Antonio Nascimento" value="{{$instituicoes->endereco}}" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Numero <i class="text-danger">*</i></label>
                                        <input type="number" name="numero" class="form-control" placeholder="268" value="{{$instituicoes->numero}}" required>
                                    </div>
                                </div>
                                <div class="form-group col-10">
                                    <label>Complemento</label>
                                    <input type="text" name="complemento" placeholder="Ex.: Apt., Loja 1, Casa" class="form-control" value="{{$instituicoes->complemento}}" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                <div class="form-group col-5">
                                    <label>Bairro <i class="text-danger">*</i></label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Centro" value="{{$instituicoes->bairro}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="bairro1" id="bairro1" value="{{$instituicoes->bairro}}">
                                </div>
                                <div class="form-group col-4">
                                    <label>Cidade <i class="text-danger">*</i></label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Pirapora" value="{{$instituicoes->cidade}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="cidade1" id="cidade1" value="{{$instituicoes->cidade}}">
                                </div>
                                <div class="form-group col-3">
                                    <label>Estado <i class="text-danger">*</i></label>
                                    <input type="text" name="estado" id="estado" class="form-control" placeholder="Minas Gerais" value="{{$instituicoes->estado}}" onkeyup="this.value = this.value.toUpperCase();" disabled>
                                    <input type="hidden" name="estado1" id="estado1" value="{{$instituicoes->estado}}">
                                </div>                                   
                            </div>
                        </div>

                        <div class="card" id="card-3">
                            <div class="card-header py-0">
                                <h5 class="section-title">Imagens</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-4 form-group">
                                    <div class="text-center">
                                        <label class="col-12 row font-weight-bold text-dark">Selecione sua logomarca  <i class="text-danger">*</i></label>
                                        <div id="PreviewImage" class="image-preview w-100" style="height: 300px; background: url('{{ (isset($instituicoes->RelationLogomarca) ? asset('storage/app/'.$instituicoes->RelationLogomarca->caminho.'?'.rand()) : '') }}') no-repeat; background-size: contain; background-position: center;">
                                            <label for="id_logomarca" id="image-label" class="text-white rounded">Selecione</label>
                                            <input type="file" accept="image/*" name="id_logomarca" id="id_logomarca" onchange="image(this);">
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
                                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(38) 3245-6653" value="{{$instituicoes->telefone}}" required>
                                </div>
                                <div class="form-group col-8">
                                    <label>E-mail <i class="text-danger">*</i></label>
                                    <input type="text" name="email" class="form-control" placeholder="suporte@compreca.com.br" value="{{$instituicoes->email}}" required>
                                </div>
                            </div>
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

@section('support')
<script type="text/javascript">
    $(document).ready(function (){
        // Mascaras
        var options = {
            onKeyPress: function (cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('#documento').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }
        $('#documento').length > 11 ? $('#documento').mask('00.000.000/0000-00', options) : $('#documento').mask('000.000.000-00#', options);
        $('#telefone').mask('(00) 00000-0000');
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
                            $(".error").html('O seu CEP não pode ser encontrado!');
                        }
                    });
                } else {
                    //cep é inválido.
                    $(".error").html('O seu CEP é inválido!');
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

        // Pré-visualização da logo
        $('#id_logomarca').on('change', function() {

            if(this.files && this.files[0]){
                $('#PreviewLogo').remove('');
                var reader = new FileReader();
                reader.onload = function (oFREvent){
                    $('div#PreviewImageLoja').append('<img class="position-absolute align-self-center" id="PreviewLogo" src="'+oFREvent.target.result+'" class="rounded" style="height: 100px;width: 220px;z-index:1000">');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    });
</script>
@endsection