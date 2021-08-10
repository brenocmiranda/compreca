@extends('admin.layouts.index')

@section('title')
Formas de pagamento
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
        <div class="section-header">
            <div class="mx-3">
                <h1>Formas de pagamento</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Plataforma</a></div>
                    <div class="breadcrumb-item active"><a href="{{route('plataforma.geral')}}">Formas de pagamento</a></div>
                </div>
            </div>
        </div>

        <div id="confirm"></div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    
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