@extends('admin.layouts.index')

@section('title')
Navbar
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Navbar</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></div>
                    <div class="breadcrumb-item active">Navbar</div>
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
                    <form method="POST" action="{{ route('salvar.navbar.marketplace') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-7">
                                    <label>Mensagem</label>
                                    <input type="text" name="mensagem" class="form-control" placeholder="Descontos especiais em ofertas acima de R$ 100,00" value="{{$navbar->mensagem}}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Mensagem de pesquisa</label>
                                    <input type="text" name="search" class="form-control" placeholder="Encontre aqui o que está procurando..." value="{{$navbar->search}}">
                                </div>
                                <div class="form-group col-5">
                                    <label>URL do Instagram</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.instagram.com/</span>
                                        <input type="text" name="instagram" class="form-control mx-2" placeholder="compreca" value="{{$navbar->instagram}}">
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label>URL do Facebook</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.facebook.com/</span>
                                        <input type="text" name="facebook" class="form-control mx-2" placeholder="compreca" value="{{$navbar->facebook}}">
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label>URL do Youtube</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.youtube.com/user/</span>
                                        <input type="tel" name="youtube" class="form-control mx-2" placeholder="compreca" value="{{$navbar->youtube}}">
                                    </div>
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
    </div>
</section>
</div>
@endsection

@section('support')
<script type="text/javascript">

</script>
@endsection