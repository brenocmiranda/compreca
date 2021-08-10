@extends('cliente.layouts.index')

@section('content')
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		@if(count($dados))
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">
					<h4 class="m-text14 p-b-7">
						Categorias
					</h4>
					<ul class="p-b-54">
						<li class="p-t-4">
							<a href="#" class="s-text13 active1">
								Todas
							</a>
						</li>

						<li class="p-t-4">
							<a href="#" class="s-text13">
								Roupas e acessórios
							</a>
						</li>

						<li class="p-t-4">
							<a href="#" class="s-text13">
								Móveis
							</a>
						</li>

						<li class="p-t-4">
							<a href="#" class="s-text13">
								Celulares
							</a>
						</li>

						<li class="p-t-4">
							<a href="#" class="s-text13">
								Calçados
							</a>
						</li>
					</ul>

					<h4 class="m-text14 row mx-auto mb-2">
						<div class="mr-auto">
							<span>Filtros</span>
						</div>
						<div class="ml-auto">
						<a class="size4 bg7 bo-rad-15 hov1 trans-0-4 px-2 pb-1 text-white">
							<label>
								<small>Aplicar</small>
							</label>
						</a>
						</div>
					</h4>
					<div class="filter-price p-t-22 p-b-50 bo3">
						<div class="m-text15 p-b-17">
							Preço
						</div>
						<div class="wra-filter-bar">
							<div id="filter-bar"></div>
						</div>
						<div class="flex-sb-m flex-w p-t-16">
							<div class="w-size11">
								<!-- Button -->
								<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
									Filter
								</button>
							</div>

							<div class="s-text3 p-t-10 p-b-10">
								Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
							</div>
						</div>
					</div>
					<div class="filter-color p-t-22 p-b-50 bo3">
						<div class="m-text15 p-b-12">
							Cores
						</div>

						<ul class="flex-w">
							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
								<label class="color-filter color-filter1" for="color-filter1"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
								<label class="color-filter color-filter2" for="color-filter2"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
								<label class="color-filter color-filter3" for="color-filter3"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
								<label class="color-filter color-filter4" for="color-filter4"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
								<label class="color-filter color-filter5" for="color-filter5"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
								<label class="color-filter color-filter6" for="color-filter6"></label>
							</li>

							<li class="m-r-10">
								<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
								<label class="color-filter color-filter7" for="color-filter7"></label>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
				<div>
					<h6>Você está procurando por: <b>{{$pesquisa}}</b></h6>
				</div>
				<hr>
				<!--  -->
				<div class="flex-sb-m flex-w p-b-35">
					<div class="col">	
						<span class="s-text8">
							 {{count($dados)}} produtos encontrados
						</span>
					</div>
					<div class="col-3">
						<select class="form-control" name="sorting" style="font-size: 14px">
							<option>Mais relevantes</option>
							<option>Menores preços</option>
							<option>Maiores preços</option>
							<option>Mais vendidos</option>
							<option>Mais avaliados</option>
						</select>
					</div>
				</div>

				<!-- Product -->
				<div class="row">
					@if(!empty($dados[0]))
						@foreach($dados as $produtos)
						<div class="col-sm-12 col-md-6 col-lg-3 p-b-50 p-4">
							<a href="produto/{{$produtos->cod_sku}}" title="{{$produtos->nome}}">
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
@endsection