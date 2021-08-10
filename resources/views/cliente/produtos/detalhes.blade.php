@section('title')
{{(isset($produto->nome) ? $produto->nome.' |' : '')}} 
@endsection

@extends('cliente.layouts.index')

@section('content')
<!-- breadcrumb -->
@if(isset($produto))
<div class="container">
	<div class="bread-crumb bgwhite flex-w p-3 pt-4">
		<a href="{{route('home.mkt')}}" class="s-text16">
			Compreca.com.br
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		@foreach($produto->RelationProdutosCategorias as $cat)
		<a href="#" class="s-text16">
			{{$cat->nome}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		@endforeach
		<a href="{{url('marcas/'.$produto->RelationMarcas->id)}}" class="s-text16">
			{{$produto->RelationMarcas->nome}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<span class="s-text17 col-2 p-0 text-truncate">
			{{$produto->nome}}
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite">
		<div class="row">
			<div class="col-7 pt-4">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					<div class="slick3 mr-4">
						<div class="item-slick3" data-thumb="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}">
							<div class="wrap-pic-w">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT" height="450">
							</div>
						</div>
						@foreach($produto->RelationImagens as $imagens)
						<div class="item-slick3" data-thumb="{{asset('storage/app').'/'.$imagens->caminho}}">
							<div class="wrap-pic-w">
								<img src="{{asset('storage/app').'/'.$imagens->caminho}}" alt="IMG-PRODUCT" height="450">
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="row col-11">
					<a href="#" title="Salvar nos seus favoritos" class="flex-w align-items-center mx-2">
						<i class="mdi mdi-heart-outline mdi-36px ml-auto px-1"></i>
						<span>Salvar nos favoritos</span>
					</a>
					<a href="#" title="Compartilhar produto" class="flex-w align-items-center mx-2">
						<i class="mdi mdi-share-variant mdi-36px ml-auto px-1"></i>
						<span>Compartilhar</span>
					</a>
				</div>
			</div>
			<div class="col-5 p-0 pt-4  mb-4">
				<div class="row col-12 p-0 mx-auto pb-3">
					<label class="text-muted">
						<span>Este produto é vendido por: </span>
						<a href="{{url('lojas/'.$produto->id_loja)}}"><b>{{$produto->RelationLojas->nome}}</b> </a>
					</label>
					<h4 class="product-detail-name m-text16">
						{{$produto->nome}}
					</h4>
					<small class="text-muted">(Cód. Item {{$produto->cod_sku}})</small>
				</div>

				<div class="row col-12 p-0 mx-auto mb-4">
					@if(isset($produto->descricao))
					<p class="s-text8 p-t-10">
						{{substr($produto->descricao, 0, 170)}}...
					</p>
					@endif
				</div>

				<div class="row mb-4">
					<div class="col-7">
						<h3 class="block2-price text-dark">
							@if($produto->preco_promocional)
							<div class="m-text15 mb-2">
								<span>
									<span>De:</span>
									<span class="text-danger" style="text-decoration: line-through">R$ {{number_format($produto->preco_venda,2,",",".")}}</span>
								</span>
							</div>
							<div>
								<span>Por:</span>
								<b>R$ {{number_format($produto->preco_promocional,2,",",".")}}</b>
							</div>
							@else
							<span>Por:</span>
							<span>R$</span> 
							<span>{{number_format($produto->preco_venda,2,",",".")}}</span>
							@endif
						</h3>
						<small>
							ou até 12x de <b>R$ {{number_format($produto->preco_venda/12,2,",",".")}}</b> sem juros
						</small>
					</div>
					<div class="col-5 p-0 ml-auto">
						<div class="btn-addcart-product-detail trans-0-4 mb-2">
							<a href="{{route('carrinho.mkt')}}">
								<button class="flex-c-m sizefull bg1 hov1 s-text2 trans-0-4 p-3 rounded">
									<span>Compre agora</span>
								</button>
							</a>
						</div>	
						<div class="btn-addcart-product-detail trans-0-4">
							<button class="flex-c-m sizefull bg1 hov1 s-text1 trans-0-4 p-1 rounded">
								<i class="mdi mdi-cart-outline mdi-18px mr-2"></i>
								<span>Adicionar ao carrinho</span>
							</button>
						</div>
					</div>
				</div>
				<hr class="col-12">
				<div class="row">
					<div class="col-12">
						<label class="font-weight-bold mb-3">Calcule o frete e o prazo de entrega estimados para sua região.</label>
						<div>
							<input type="search" name="cep" class="p-2 border rounded" placeholder="digite seu CEP">
							<button class="btn btn-outline-secondary btn-sm px-2">
								<i class="mdi mdi-magnify mdi-18px"></i>
							</button>
						</div>
					</div>
				</div>
				<hr class="col-12">
			</div>

			<div class="col-12">
				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Características
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Especificações Técnicas
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Dimensões
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Descrição do produto
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							@if(isset($produto->descricao))
							{{$produto->descricao}}
							@else
							<span>Esse produto não possui nenhuma descrição.</span>
							@endif
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Quem viu, comprou
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Herschel supply co 25l
								</a>

								<span class="block2-price m-text6 p-r-5">
									$75.00
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Denim jacket blue
								</a>

								<span class="block2-price m-text6 p-r-5">
									$92.50
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Coach slim easton black
								</a>

								<span class="block2-price m-text6 p-r-5">
									$165.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Frayed denim shorts
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$29.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									$15.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Herschel supply co 25l
								</a>

								<span class="block2-price m-text6 p-r-5">
									$75.00
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Denim jacket blue
								</a>

								<span class="block2-price m-text6 p-r-5">
									$92.50
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Coach slim easton black
								</a>

								<span class="block2-price m-text6 p-r-5">
									$165.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="{{asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Frayed denim shorts
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$29.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									$15.90
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
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
				<h5 class="font-weight-bold mb-3">Ops! nenhum produto encontrado com esse código.</h5>
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