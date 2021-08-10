@section('title')
Loja parceiras  
@endsection

@extends('cliente.layouts.index')

@section('content')

@if(isset($dados))
<section class=" flex-col-c-m bg-light t-center py-5">
	<h2 class="l-text3 text-dark">
		Lojas parceiras
	</h2>
</section>

<div class="container">
	<div class="bread-crumb bgwhite flex-w p-3 pt-4">
		<a href="{{route('home.mkt')}}" class="s-text16">
			Compreca.com.br
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17 col-2 p-0 text-truncate">
			Lojas parceiras
		</span>
	</div>

	<div class="container row bgwhite mt-4 mb-5">
		@foreach($dados as $loja)
		<div class="col-3 block1 hov-img-zoom pos-relative mb-3" style="height: 350px">
			<a href="{{url('lojas/'.$loja->id)}}">
				<div class="h-100 d-flex align-items-end">
					<div class="w-100 position-absolute h-100 rounded" style="background-image: url({{asset('storage/app').'/'.$loja->RelationImagens->caminho}}); background-size: cover; background-position: center; filter: brightness(0.5);"></div> 
					<img src="{{ asset('storage/app/').'/'.$loja->RelationLogomarca->caminho }}" alt="{{$loja->nome}}" class="position-relative col-10 mx-auto mt-auto pb-4">
				</div>
			</a>
		</div>
		@endforeach
	</div>
</div>
@else
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row mx-auto col-sm-6 col-md-8 col-lg-9 p-b-50">
			<div class="col-3 text-right my-auto pr-4">
				<svg id="icon-sad-face text-muted" viewBox="0 0 63 80"  style="height: 80px;">
					<path fill="inherit" d="M8.5 28a8.5 8.5 0 1 1 0-17 8.5 8.5 0 0 1 0 17zm0 40a8.5 8.5 0 1 1 0-17 8.5 8.5 0 0 1 0 17zM63 80h-8.734C44.755 65.063 40 51.28 40 38.65 40 26.02 44.756 13.137 54.266 0H63c-7.492 9.97-11.238 22.854-11.238 38.65S55.508 68.23 63 80z"></path>
				</svg>
			</div>
			<div class="col-9">
				<h5 class="font-weight-bold mb-3">Ops! nenhuma loja encontrada.</h5>
				<h6 class="font-weight-bold mb-3">O que eu faço?</h6>
				<ul class="px-5">
					<li class="mb-2"> <i class="mdi mdi-record text-warning"></i> Tente utilizar o campo de busca acima para detectar o produto desejado.</li>
					<li> <i class="mdi mdi-record text-warning"></i> Navegue pelos departamentos e encontre-o.</li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endif
@endsection