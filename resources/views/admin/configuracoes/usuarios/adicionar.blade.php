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
                    <div class="breadcrumb-item active"><a href="{{route('configuracoes')}}">Configurações</a></div>
                    <div class="breadcrumb-item active"><a href="{{route('configuracoes.usuarios')}}">Usuários</a></div>
                    <div class="breadcrumb-item">Adicionar</div>
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
                    <form method="POST" action="{{ route('configuracoes.salvar.usuarios') }}"  enctype="multipart/form-data">
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
                                            <div class="form-group col-8">
                                                <label>Grupos de permissões <i class="text-danger">*</i></label>
                                                <div class="d-flex align-items-center">
                                                    <div class="col-7 p-0">
                                                        <select class="id_grupo" name="id_grupo" id="listaGrupos" required>
                                                            <option disabled="disabled">Selecione</option>
                                                            @foreach($grupos as $grupo)
                                                                @if($grupo->visivel == 1)
                                                                    <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                    <a href="{{ route('configuracoes.usuarios') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
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
    });
</script>
@endsection
