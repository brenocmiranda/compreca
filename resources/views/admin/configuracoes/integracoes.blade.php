@extends('admin.layouts.index')

@section('title')
Configurações
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Integrações</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('configuracoes')}}">Configurações</a></div>
                    <div class="breadcrumb-item active"><a href="{{route('configuracoes.integracoes')}}">Integrações</a></div>
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

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf

                        <div class="card" id="card-1">
                            <div class="card-body">
                                Página ainda em desenvolvimento.
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
    
    });
</script>
@endsection