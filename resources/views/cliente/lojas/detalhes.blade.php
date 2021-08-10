@section('title')
{{$dados->nome}} &#183 Loja parceiras  
@endsection

@extends('cliente.layouts.index')

@section('content')
<!-- breadcrumb -->
@if(isset($dados))
<section class=" flex-col-c-m bg-light t-center py-5">
	<h2 class="l-text3 text-dark">
		Lojas parceiras &#183 <img src="{{ asset('storage/app/'.$dados->RelationLogomarca->caminho.'?'.rand()) }}" class="rounded" style="width: 150px;z-index:1000">
	</h2>
</section>

<div class="container">
	<div class="bread-crumb bgwhite flex-w p-3 pt-4">
		<a href="{{route('home.mkt')}}" class="s-text16">
			Compreca.com.br
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<a href="{{route('listar.lojas.mkt')}}" class="s-text16">
			Lojas parceiras
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17 col-2 p-0 text-truncate">
			{{$dados->nome}}
		</span>
	</div>

	<div class="container bgwhite mt-4 mb-5">
		<div class="row">
			<div class="col-5">
				<div class="d-flex px-4 mb-3 justify-content-center" id="PreviewImageLoja">
					@if(isset($dados->RelationImagens))
					<img class="w-100 rounded" id="PreviewFundo" src="{{ asset('storage/app/'.$dados->RelationImagens->caminho.'?'.rand()) }}" class="rounded" style="height: 300px;">
					@else
					<img class="w-100 rounded" id="PreviewFundo" src="{{ asset('public/admin/img/system/product.png').'?'.rand() }}" class="rounded">
					@endif
				</div>
			</div>
			<div class="col-6">
				<div class="mb-2">
					<h3>{{$dados->nome}}</h3>
					<label class="mt-1 text-muted">({{$dados->documento}})</label>
				</div>
				<div class="mb-4">
					<p class="loja-text">{{$dados->descricao}}</p>
				</div>
				<div>
					<p style="line-height: 10px">
						<label class="d-block">{{$dados->endereco}}, {{$dados->numero.(isset($dados->complemento) ? ' - '.$dados->complemento : '')}} - {{$dados->bairro}}</label>
						<label class="d-block">{{$dados->cidade}} - {{$dados->estado}}</label>	
						<label class="d-block">{{substr($dados->cep, 0, 5).'-'.substr($dados->cep, 5, 7)}}</label>
					</p>
				</div>
				<div class="mt-3 text-right">
					<a href="https://www.facebook.com/{{$dados->url_facebook}}" class="topbar-social-item fa fa-facebook"></a>
					<a href="https://www.facebook.com/{{$dados->url_instagram}}" class="topbar-social-item fa fa-instagram"></a>
					<a href="https://api.whatsapp.com/send?phone={{$dados->url_whatsapp}}" class="topbar-social-item fa fa-whatsapp"></a>
					<a href="mailto:{{$dados->email}}" class="topbar-social-item fa fa-envelope"></a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div>
		<section class="relateproduct bgwhite p-t-45 p-b-50">
			<div class="container">
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						Marcas vendidas
					</h3>
				</div>
				@if(isset($dados->RelationMarcas[0]))
				<!-- Slide2 -->
				<div class="wrap-slick2">
					<div class="slick2">
						@foreach($dados->RelationMarcas as $marcas)
						<div class="item-slick2 p-l-15 p-r-15">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="{{ asset('storage/app/'.$marcas->RelationImagens->caminho.'?'.rand()) }}" alt="IMG-PRODUCT" height="300">
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				@else
					<div class="text-center">
						<h5>Não possui nenhuma marca vinculada</h5>
					</div>
				@endif
			</div>
		</section>
	</div>
	<hr>
	<div>
		<section class="bgwhite p-t-55 p-b-65">
			<div class="container">
				@if(count($dados->RelationProdutos))
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						Veja seus produtos
					</h3>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 p-b-50">
						<!-- Product -->
						<div class="row">
							@if(!empty($dados->RelationProdutos[0]))
								@foreach($dados->RelationProdutos as $produtos)
								<div class="col-sm-12 col-md-6 col-lg-3 p-b-50 p-4">
									<a href="{{url('produto/'.$produtos->cod_sku)}}" title="{{$produtos->nome}}">
										<!-- Block2 -->
										<div class="block2">
											<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
												<img src="{{asset('storage/app').'/'.$produtos->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT" height="152" width="152">
											</div>
											<div class="block2-txt mt-3">
												<div class="block2-name dis-block s-text3 pb-3" >
													<label class="product-text">{{$produtos->nome}}</label>
												</div>
												<span class="block2-price m-text6 p-r-5">
													<h6>
														@if($produtos->preco_promocional)
														<b>R$ {{number_format($produtos->preco_promocional,2,",",".")}}</b>
														<label class="mb-0"><small class="text-danger" style="text-decoration: line-through">R$ {{number_format($produtos->preco_venda,2,",",".")}}</small></label>
														@else
														R$ {{number_format($produtos->preco_venda,2,",",".")}}
														@endif
													</h6>
												</span>
												<small>
													até 12x de <b>R$ {{number_format($produtos->preco_venda/12,2,",",".")}}</b> s/ juros
												</small>
											</div>
										</div>
									</a>
								</div>
								@endforeach
							@else
								<div class="text-center">
									<h5>Não possui nenhum produto cadastrado</h5>
								</div>
							@endif
						</div>

						<!-- Pagination -->
						<div class="pagination flex-m flex-w p-t-26 ">
							<div class="col-12 row justify-content-end">
								<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
								<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
							</div>
						</div>
					</div>			
				</div>
				@else
				<div class="row mx-auto col-sm-6 col-md-8 col-lg-9 p-b-50">
					<div class="col-3 text-right my-auto pr-4">
						<svg id="icon-sad-face text-muted" viewBox="0 0 63 80"  style="height: 80px;">
							<path fill="inherit" d="M8.5 28a8.5 8.5 0 1 1 0-17 8.5 8.5 0 0 1 0 17zm0 40a8.5 8.5 0 1 1 0-17 8.5 8.5 0 0 1 0 17zM63 80h-8.734C44.755 65.063 40 51.28 40 38.65 40 26.02 44.756 13.137 54.266 0H63c-7.492 9.97-11.238 22.854-11.238 38.65S55.508 68.23 63 80z"></path>
						</svg>
					</div>
					<div class="col-9">
						<h5 class="font-weight-bold mb-3">Ops! nenhum resultado encontrado para "{{$pesquisa}}".</h5>
						<h6 class="font-weight-bold mb-3">O que eu faço?</h6>
						<ul class="px-5">
							<li class="mb-2"> <i class="mdi mdi-record text-warning"></i> Verifique os termos digitados ou os filtros selecionados.</li>
							<li> <i class="mdi mdi-record text-warning"></i> Utilize termos genéricos na busca.</li>
						</ul>
					</div>
				</div>
				@endif
			</div>
		</section>
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
				<h5 class="font-weight-bold mb-3">Ops! nenhuma loja encontrada com esse código.</h5>
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