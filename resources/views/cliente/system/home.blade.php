@extends('cliente.layouts.index')

@section('content')
<!-- Slide1 -->
<section class="slide1">
	<div class="wrap-slick1">
		<div class="slick1">
			@foreach($slider as $slide)
				@if(!empty($slide->text_button))
					<div class="item-slick1 item1-slick1" >
						<div class="position-absolute h-100 w-100 img-slider" style="background-image: url({{ asset('storage/app').'/'.$slide->RelationImagens->caminho}}); filter: brightness({{$slide->escurecer}});"></div>
						<div class="position-relative wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
							<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
								{{$slide->title}}
							</span>
							<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
								{{$slide->text}}
							</h2>
							<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
								<!-- Button -->
								<a href="{{$slide->tagName}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
									{{$slide->text_button}}
								</a>
							</div>
						</div>
					</div>
				@else
					<div class="item-slick1 item1-slick1">
						<a href="{{$slide->tagName}}">
							<div class="position-absolute h-100 w-100 img-slider" style="background-image: url({{ asset('storage/app').'/'.$slide->RelationImagens->caminho}}); filter: brightness({{$slide->escurecer}});"></div>
							<div class="position-relative wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
								<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
									{{$slide->title}}
								</span>
								<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
									{{$slide->text}}
								</h2>
							</div>
						</a>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</section>

@foreach($sections->sortBy('section') as $dados)
	@if($dados->carousel == 1)
		<section class="{{$dados->type}} bgwhite p-t-45 p-b-105" style="background-color:{{$dados->background}}!important;">
			<div class="{{($dados->container == 1 ? 'container' : '')}}">
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						{{$dados->title}}
					</h3>
				</div>
				<div class="wrap-slick2 {{($dados->container == 1 ? 'container' : 'w-100 col-10 mx-auto')}}  {{$dados->style}}">
					<div class="slick2">
						@foreach($cards as $card)
							@if($card->section == $dados->id)
								<div class="item-slick2 p-l-15 p-r-15">
									<div class="card text-center {{$dados->style_card}}">
										<div class="block2-img wrap-pic-w of-hidden pos-relative">
											@if($dados->type == 'categorias')
											<a href="{{url('categorias/'.$card->id_categoria)}}">
												<div class="img-slider mx-auto" style="background-image: url('{{asset('storage/app').'/'.$card->RelationCategorias->RelationImagens->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@elseif($dados->type == 'marcas')
											<a href="{{url('marcas/'.$card->id_marca)}}">
												<div class="img-slider w-100" style="background-image: url('{{asset('storage/app').'/'.$card->RelationMarcas->RelationImagens->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@elseif($dados->type == 'produtos')
											<a href="{{url('produto/'.$card->RelationProdutos->cod_sku)}}">
												<div class="img-slider mx-auto" style="background-image: url('{{asset('storage/app').'/'.$card->RelationProdutos->RelationImagensPrincipal->first()->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@elseif($dados->type == 'lojas')
											<a href="{{url('lojas/'.$card->id_loja)}}">
												<div class="img-slider mx-auto" style="background-image: url('{{asset('storage/app').'/'.$card->RelationLojas->RelationImagens->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@elseif($dados->type == 'instituicoes')
											<a href="{{url('instituicoes/'.$card->id_instituicoes)}}">
												<div class="img-slider mx-auto" style="background-image: url('{{asset('storage/app').'/'.$card->RelationInstituicoes->RelationLogomarca->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@else($dados->type == 'outros')
											<a href="{{url('outros/'.$card->id_imagem)}}">
												<div class="img-slider mx-auto" style="background-image: url('{{asset('storage/app').'/'.$card->RelationImagens->caminho}}'); height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
												</div>
											</a>
											@endif
										</div>
										@if($dados->type == 'produtos')
										<div class="block2-txt text-left p-3">
											<a href="{{url('produto/'.$card->RelationProdutos->cod_sku)}}" class="block2-name dis-block s-text3 pb-4" title="{{$card->RelationProdutos->nome}}">
												<label class="product-text" style="cursor: pointer;">{{$card->RelationProdutos->nome}}...</label>
											</a>
											<h5 class="block2-price text-dark">
												@if($card->RelationProdutos->preco_promocional)
													<b>R$ {{number_format($card->RelationProdutos->preco_promocional,2,",",".")}}</b>
													<label class="mb-0"><small class="text-danger" style="text-decoration: line-through">R$ {{number_format($card->RelationProdutos->preco_venda,2,",",".")}}</small></label>
												@else
													R$ {{number_format($card->RelationProdutos->preco_venda,2,",",".")}}
												@endif
											</h5>
											<small>
												até 12x de <b>R$ {{number_format($card->RelationProdutos->preco_venda/12,2,",",".")}}</b> s/ juros
											</small>
										</div>
										@endif
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</section>
	@else
		<section class="{{$dados->type}} bg-light p-t-60 p-b-40" style="background-color:{{$dados->background}}!important;">
			<div class="{{($dados->container == 1 ? 'container' : 'w-100 col-10 mx-auto')}}">
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						{{$dados->title}}
					</h3>
				</div>
				<div class="row">
					<div class="row col-sm-12 col-md-12 col-lg-12 justify-content-center {{$dados->style}}">
						@foreach($cards as $card)
							@if($card->section == $dados->id)
								<div class="block1 hov-img-zoom pos-relative mx-3 mb-3 {{$card->style_card}}" style="height: {{$dados->height_card}}px; width: {{$dados->width_card}}px">
									@if($dados->type == 'categorias')
										<a href="{{url('categorias/'.$card->id_categoria)}}">
											<img src="{{ asset('storage/app/').'/'.$card->RelationCategorias->RelationImagens->caminho }}" alt="{{$card->RelationCategorias->nome}}" class="w-100 h-100">
										</a>
									@elseif($dados->type == 'marcas')
										<a href="{{url('marcas/'.$card->id_marca)}}">
											<img src="{{ asset('storage/app/').'/'.$card->RelationMarcas->RelationImagens->caminho }}" alt="{{$card->RelationMarcas->nome}}" class="w-100 h-100">
										</a>
									@elseif($dados->type == 'produtos')
										<a href="{{url('produto/'.$card->RelationProdutos->cod_sku)}}">
											<img src="{{ asset('storage/app/').'/'.$card->RelationProdutos->RelationImagensPrincipal->first()->caminho }}" alt="{{$card->RelationProdutos->nome}}" class="w-100 h-100">
										</a>
									@elseif($dados->type == 'lojas')
										<a href="{{url('lojas/'.$card->id_loja)}}">
											<div class="h-100 d-flex align-items-end">
												<div class="w-100 position-absolute h-100 rounded" style="background-image: url({{asset('storage/app').'/'.$card->RelationLojas->RelationImagens->caminho}}); background-size: cover; background-position: center; filter: brightness(0.5);"></div> 
												<img src="{{ asset('storage/app/').'/'.$card->RelationLojas->RelationLogomarca->caminho }}" alt="{{$card->RelationLojas->nome}}" class="position-relative col-10 mx-auto mt-auto pb-4">
											</div>
										</a>
									@elseif($dados->type == 'instituicoes')
										<a href="{{url('instituicoes/'.$card->id_instituicoes)}}">
											<img src="{{ asset('storage/app/').'/'.$card->RelationInstituicoes->RelationLogomarca->caminho }}" alt="{{$card->RelationInstituicoes->nome}}" class="w-100 h-100">
										</a>
									@else($dados->type == 'outros')
										<a href="{{url('outros/'.$card->id_imagem)}}">
											<img src="{{ asset('storage/app/').'/'.$card->RelationImagens->caminho }}" alt="Card outros" class="w-100 h-100">
										</a>
									@endif
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</section>
	@endif
@endforeach

<!-- Indicações -->
<section class="banner2 bg-white p-t-55 p-b-55">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
				<div class="hov-img-zoom pos-relative">
					<img src="{{ asset('public/clients/images/banner-08.jpg') }}" alt="IMG-BANNER">

					<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
						<span class="m-text9 p-t-45 fs-20-sm">
							The Beauty
						</span>

						<h3 class="l-text1 fs-35-sm">
							Lookbook
						</h3>

						<a href="#" class="s-text4 hov2 p-t-20 ">
							View Collection
						</a>
					</div>
				</div>
			</div>

			<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
				<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm">
					<img src="{{ asset('public/clients/images/shop-item-09.jpg') }}" alt="IMG-BANNER">

					<div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
						<div class="t-center">
							<a href="product-detail.html" class="dis-block s-text3 p-b-5">
								Gafas sol Hawkers one
							</a>

							<span class="block2-oldprice m-text7 p-r-5">
								$29.50
							</span>

							<span class="block2-newprice m-text8">
								$15.90
							</span>
						</div>

						<div class="flex-c-m p-t-44 p-t-30-xl">
							<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
								<span class="m-text10 p-b-1 days">
									69
								</span>

								<span class="s-text5">
									days
								</span>
							</div>

							<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
								<span class="m-text10 p-b-1 hours">
									04
								</span>

								<span class="s-text5">
									hrs
								</span>
							</div>

							<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
								<span class="m-text10 p-b-1 minutes">
									32
								</span>

								<span class="s-text5">
									mins
								</span>
							</div>

							<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
								<span class="m-text10 p-b-1 seconds">
									05
								</span>

								<span class="s-text5">
									secs
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Indicações -->


<!-- Instagram -->
<section class="instagram p-t-20">
	<div class="sec-title p-b-52 p-l-15 p-r-15">
		<h3 class="m-text5 t-center">
			@Marcações no Instragram
		</h3>
	</div>

	<div class="flex-w">
		<!-- Block4 -->
		<div class="block4 wrap-pic-w">
			<img src="{{ asset('public/clients/images/gallery-03.jpg') }}" alt="IMG-INSTAGRAM">

			<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
				<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
					<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
					<span class="p-t-2">39</span>
				</span>

				<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
					<p class="s-text10 m-b-15 h-size1 of-hidden">
						Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
					</p>

					<span class="s-text9">
						Photo by @nancyward
					</span>
				</div>
			</a>
		</div>

		<!-- Block4 -->
		<div class="block4 wrap-pic-w">
			<img src="{{ asset('public/clients/images/gallery-07.jpg') }}" alt="IMG-INSTAGRAM">

			<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
				<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
					<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
					<span class="p-t-2">39</span>
				</span>

				<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
					<p class="s-text10 m-b-15 h-size1 of-hidden">
						Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
					</p>

					<span class="s-text9">
						Photo by @nancyward
					</span>
				</div>
			</a>
		</div>

		<!-- Block4 -->
		<div class="block4 wrap-pic-w">
			<img src="{{ asset('public/clients/images/gallery-09.jpg') }}" alt="IMG-INSTAGRAM">

			<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
				<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
					<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
					<span class="p-t-2">39</span>
				</span>

				<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
					<p class="s-text10 m-b-15 h-size1 of-hidden">
						Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
					</p>

					<span class="s-text9">
						Photo by @nancyward
					</span>
				</div>
			</a>
		</div>

		<!-- Block4 -->
		<div class="block4 wrap-pic-w">
			<img src="{{ asset('public/clients/images/gallery-13.jpg') }}" alt="IMG-INSTAGRAM">

			<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
				<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
					<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
					<span class="p-t-2">39</span>
				</span>

				<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
					<p class="s-text10 m-b-15 h-size1 of-hidden">
						Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
					</p>

					<span class="s-text9">
						Photo by @nancyward
					</span>
				</div>
			</a>
		</div>

		<!-- Block4 -->
		<div class="block4 wrap-pic-w">
			<img src="{{ asset('public/clients/images/gallery-15.jpg') }}" alt="IMG-INSTAGRAM">

			<a href="#" class="block4-overlay sizefull ab-t-l trans-0-4">
				<span class="block4-overlay-heart s-text9 flex-m trans-0-4 p-l-40 p-t-25">
					<i class="icon_heart_alt fs-20 p-r-12" aria-hidden="true"></i>
					<span class="p-t-2">39</span>
				</span>

				<div class="block4-overlay-txt trans-0-4 p-l-40 p-r-25 p-b-30">
					<p class="s-text10 m-b-15 h-size1 of-hidden">
						Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit amet enim orci. Nam eget metus elit.
					</p>

					<span class="s-text9">
						Photo by @nancyward
					</span>
				</div>
			</a>
		</div>
	</div>
</section>
<!-- Instagram -->


<!-- Shipping -->
<section class="shipping bgwhite p-t-62 p-b-46">
	<div class="flex-w p-l-15 p-r-15">
		<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
			<h4 class="m-text12 t-center">
				Vendas por Empresas Locais
			</h4>
			<a href="#" class="s-text11 t-center">
				Saiba mais 
			</a>
		</div>

		<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
			<h4 class="m-text12 t-center">
				Trocas ou devoluções efetuadas em até 7 dias
			</h4>
			<span class="s-text11 t-center">
				Não gostou? Vá até a loja ou solicite a devolução
			</span>
		</div>

		<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
			<h4 class="m-text12 t-center">
				Store Opening
			</h4>
			<span class="s-text11 t-center">
				Shop open from Monday to Sunday
			</span>
		</div>
	</div>
</section>
<!-- Shipping -->
@endsection