@extends('admin.layouts.index')

@section('title')
Nova variação
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Nova variação</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.produtos')}}">Produtos</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.variacoes')}}">Variações</a></div>
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

                    <form method="POST" action="{{ route('salvar.variacoes') }}" >
                        @csrf
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
                                <div class="form-group col-8">
                                    <label>Nome da variação <i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder=" Ex.: Tamanho M" required>
                                </div>
                                <div class="form-group col-12">
                                    <label class="mb-0">Opções <i class="text-danger">*</i></label>
                                    <div class="d-flex align-items-center">
                                        <div class="col-4 p-0">
                                            <select class="id_opcao" name="id_opcao">
                                                <option disabled>Selecione uma opção</option>
                                                @foreach($opcoes as $opcao)
                                                <option value="{{$opcao->id}}">{{$opcao->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <a class="d-flex my-auto btn waves-effect waves-light text-white mx-3" data-toggle="modal" data-target="#variacao-opcao"> 
                                                <i class="mdi mdi-plus"></i> 
                                                <b class="px-1">Cadastrar opção</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Valor <i class="text-danger">*</i></label>
                                    <input type="text" name="valor" class="form-control" placeholder=" Ex.: PP, P, M, G, GG" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('exibir.variacoes') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
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
    @include('admin.variacoes.opcao')
@endsection

@section('support')
<script type="text/javascript">
    $(document).ready(function (){
        $('#variacao-opcao #formOpcao').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '{{ route("opcoes.variacoes") }}',
                type: 'POST',
                data: $('#variacao-opcao #formOpcao').serialize(),
                beforeSend: function(){
                    $('#variacao-opcao #formOpcao').addClass('d-none');
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Salvando informações...</label></div>');
                },
                success: function(data){
                    $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3" style="font-size:62px;"></i></div><label>Opção adicionada com sucesso!</label></div>');
                    setTimeout(function(){
                        $('#variacao-opcao #formOpcao').each (function(){
                            this.reset();
                        });
                        $('.id_opcao').html('');
                        $(data).each(function(index, element){
                            $('.id_opcao').append('<option value="'+element.id+'">'+element.nome+'</option>');
                        });
                        $('select').formSelect('destroy');
                        $('select').formSelect();
                        $('input').removeClass('border border-danger');
                        $('.carregamento').html('');
                        $('#variacao-opcao #formOpcao').removeClass('d-none');
                        $('#variacao-opcao').modal('hide');
                    }, 800);
                }, error: function (data) {
                    setTimeout(function(){
                        $('#variacao-opcao #formOpcao').removeClass('d-none');
                        $('.carregamento').html('');
                        if(!data.responseJSON){
                            console.log(data.responseText);
                            $('#variacao-opcao #err').html(data.responseText);
                        }else{
                            $('#variacao-opcao #err').html('');
                            $('input').removeClass('border border-danger');
                            $.each(data.responseJSON.errors, function(key, value){
                                $('#variacao-opcao #err').append('<div class="text-danger ml-3"><p>'+value+'</p></div>');
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
