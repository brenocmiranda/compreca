@extends('cliente.layouts.index')

@section('content')
<section class="cart bgwhite p-b-100">
		<div class="container-fluid">
			<div class="col-12 row mx-auto">
			<div class="col-8">
				<div class="container-table-cart pos-relative">
					<div class="wrap-table-shopping-cart bgwhite">
						<table class="table-shopping-cart">
							<tr class="row col-12 mx-auto table-head">
								<th class="col-8">Produtos</th>
								<th class="col-2 text-center">Quantidade</th>
								<th class="col-2 text-center">Total</th>
							</tr>

							<tr class="row col-12 mx-auto table-row">
								<td class="row col-8 m-0">
									<div class="col-2 cart-img-product b-rad-4 o-f-hidden">
										<img src="http://localhost/compreca/storage/app/plataforma/034228202008145f360824bc3f7.png" alt="IMG-PRODUCT">
									</div>
									<div class="col-10 px-3">
										<label class="font-weight-bold">Geladeira / Refrigerador Brastemp Frost Free BRM44 375 Litros - Branco - 110V</label>
									</div>
								</td>
								<td class="col-2">
									<div class="flex-w bo5 of-hidden w-size17">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
										</button>
										<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="1">
										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
									<div class="text-center">
										<a href="#">
											<i class="mdi mdi-close"></i>
											<small>Remover</small>
										</a>
									</div>
								</td>
								<td class="row col-2 m-0">
									<div class="mx-auto">
										<span>R$ 36.00</span>
									</div>
								</td>
							</tr>

							<tr class="row col-12 mx-auto table-row">
								<td class="row col-8 m-0">
									<div class="col-2 cart-img-product b-rad-4 o-f-hidden">
										<img src="http://localhost/compreca/storage/app/plataforma/034228202008145f360824bc3f7.png" alt="IMG-PRODUCT">
									</div>
									<div class="col-10 px-3">
										<label class="font-weight-bold">Mug Adventure</label>
									</div>
								</td>
								<td class="col-2">
									<div class="flex-w bo5 of-hidden w-size17">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
										</button>
										<input class="size8 m-text18 t-center num-product" type="number" name="num-product2" value="1">
										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
									<div class="text-center">
										<a href="#">
											<i class="mdi mdi-close"></i>
											<small>Remover</small>
										</a>
									</div>
								</td>
								<td class="row col-2 m-0">
									<div class="mx-auto">
										<span>R$ 16.00</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="bo9 p-4 mt-5">
					<h5 class="m-text20 p-b-24">
						Resumo da compra
					</h5>
					<div class="flex-w flex-sb-m p-b-12">
							<span class="s-text18 w-size19 w-full-sm text-left">
								2 produtos:
							</span>
							<span class="m-text21 w-size20 w-full-sm text-right">
								R$ 52.00
							</span>
					</div>
					<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
						<span class="s-text18 w-size19 w-full-sm">
							Frete:
						</span>
						<div>
							<input type="search" name="cep" class="p-2 border rounded" placeholder="digite seu CEP">
							<button class="btn btn-outline-secondary btn-sm px-2">
								<i class="mdi mdi-magnify mdi-18px"></i>
							</button>
						</div>
					</div>

					<!--  -->
					<div class="flex-w flex-sb-m">
						<div class="flex-w flex-sb-m my-4 w-100">
							<span class="m-text22 w-size19 w-full-sm text-left">
								Total:
							</span>
							<span class="m-text21 w-size20 w-full-sm text-right">
								R$ 52.00
							</span>
						</div>
						<div class="col-10 mx-auto size15 trans-0-4 mt-3">
							<button class="flex-c-m sizefull bg1 hov1 s-text1 trans-0-4">
								Continuar
							</button>
						</div>
						<div>
							<label class="col-12 mx-auto my-4 text-center">
							Possui cupom ou vale? você poderá usá-los na etapa de pagamento.
							</label>
						</div>
					</div>

					
				</div>
			</div>
		</div>
		</div>
	</section>
@endsection