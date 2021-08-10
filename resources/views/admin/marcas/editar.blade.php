@extends('admin.layouts.index')

@section('title')
Editar marcas
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">.
        <div class="section-header">
            <div class="mx-3">
                <h1>Editar marca</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.produtos')}}">Produtos</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.marcas')}}">Marcas</a></div>
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
                    <form method="POST" action="{{ route('editando.marcas', $marca->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="card-1">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-8">
                                    <div class="form-group col-12">
                                        <label class="custom-switch px-0">
                                            <input type="checkbox" name="status" class="custom-switch-input" {{($marca->status == 1 ? ' checked' : '')}}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"><b>Ativo</b></span>
                                        </label>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Nome da marca <i class="text-danger">*</i></label>
                                        <input type="text" name="nome" class="form-control" value="{{$marca->nome}}" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Descrição da marca</label>
                                        <textarea class="summernote" name="descricao">{{$marca->descricao}}</textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <label class="col-12 row font-weight-bold text-dark">Selecione a imagem <i class="text-danger">*</i></label>
                                            <div id="PreviewImage" class="image-preview w-100" style="height: 300px; background: url('{{ ( isset($marca->RelationImagens->caminho) ? asset('storage/app').'/'.$marca->RelationImagens->caminho.'?'.rand() : '') }}') no-repeat; background-size: contain; background-position: center;">
                                                <label for="id_imagem" id="image-label" class="text-white rounded">Selecione</label>
                                                <input type="file" accept="image/*" name="id_imagem" id="id_imagem" onchange="image(this);">
                                            </div> 
                                            <small class="my-2">Aceitamos .png, .jpg ou .svg</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('exibir.marcas') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
                            <button class="btn waves-effect waves-light col-2 mx-1">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
