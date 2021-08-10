@extends('admin.layouts.index')

@section('title')
Página inicial
@endsection

@section('content')
<div class="main-content vh-100">
    <section class="section h-100">
        <div class="col-12 h-100 row">
        	<div class="col-7 m-auto">
        		<div class="mb-5 d-flex">
        			<div>
			        	<h1 class="mb-3 text-dark">Olá, {{explode(" ", Auth::guard('admin')->user()->nome)[0]}}!</h1>
			        	<h6 class="font-weight-normal mb-3" style="line-height: 25px;">Seja bem-vindo ao painel administrativo da <b> {{(isset(Auth::guard('admin')->user()->RelationLojas) ? Auth::guard('admin')->user()->RelationLojas->nome : 'Não atribuído') }}</b>, nunca foi tão fácil e rápido vender pela internet.</h6>
			        	<h6 class="font-weight-normal"><b>Último acesso:</b> {{(isset(Auth::guard('admin')->user()->RelationAtividades) ? date_format(Auth::guard('admin')->user()->RelationAtividades->created_at, "d/m/Y H:i:s") : '')}} - {{(isset(Auth::guard('admin')->user()->RelationAtividades) ? @Auth::guard('admin')->user()->RelationAtividades->created_at->subMinutes(2)->diffForHumans() : '')}}</h6>
			        </div>
		        	<div class="ml-auto pl-5">
		        		<img class="rounded-circle" id="PreviewImage" src="{{ (isset(Auth::guard('admin')->user()->RelationImagens) ? asset('storage/app/'.Auth::guard('admin')->user()->RelationImagens->caminho.'?'.rand()) : asset('public/admin/img/user.png')) }}" style="height: 120px;width: 120px;">
		        	</div>
		        </div>
	        	<hr>
	        </div>
        </div>
    </section>
</div>
@endsection
