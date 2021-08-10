@extends('admin.layouts.index')

@section('title')
Novo lead
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Novo lead</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="{{route('exibir.clientes')}}">Clientes</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.leads')}}">Leads</a></div>
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

                    <form method="POST" action="{{ route('salvar.leads') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="card-1">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-7">
                                    <label>Nome <i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="Digite aqui o nome" onkeyup="this.value = this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>E-mail <i class="text-danger">*</i></label>
                                    <input type="email" name="email" class="form-control" placeholder="Entre com o email" required>
                                </div>
                                <div class="form-group col-3">
                                    <label>Telefone</label>
                                    <input type="text" name="tel_contato" class="telefone form-control" placeholder="(00) 00000-0000">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('exibir.leads') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
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
        $('.telefone').mask('(00) 00000-0000');
    });
</script>
@endsection