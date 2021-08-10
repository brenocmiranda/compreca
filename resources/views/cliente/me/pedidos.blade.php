@extends('cliente.layouts.index')

@section('content')
<div class="container my-4">
		
	@if(Session::has('confirm'))
	<p class="text-center alert alert-{{ Session::get('confirm')['class'] }}">
		{{ Session::get('confirm')['mensagem'] }}
	</p>
	@endif

	@if(!isset(Auth::user()->email_verified_at))
	<div class="alert alert-warning text-center">
		<label><b>É necessário confirmação dos seus dados!</b> Foi encaminhado um e-mail de verificação para sua caixa de entrada, siga as instruções e confirme seu cadastro.</label>
	</div>
	@endif
	
	<div class="col-12">
		<div class="row">
			<div class="col-3">
				@include('cliente.me.leftbar')
			</div>
			<div class="col-9 p-4">
				<div class="row mb-4">
					<h4>Meus pedidos</h4>
					<hr class="col-12">
				</div>
				<div class="col-12">
					<div class="row">
						<div class="border rounded col-7 input-group p-0 ml-auto" style="border-radius: 80px !important;">
							<input type="search" name="pesquisa" class="mx-2 col" placeholder="Encontre seu pedido...">
							<div class="input-group-prepend">
								<button>
									<i class="mx-4 mdi mdi-magnify mdi-24px"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div style="border-left: 5px solid #9E9E9E !important;">
					<div class="border col-12 py-3 my-4">
						<div class="d-flex align-items-center">
							<h6 class="font-weight-bold px-2">Pedido: 02-664738686</h6>
							<i class="ml-auto mdi mdi-chevron-down mdi-36px"></i>
						</div>
						<hr>
						<div class="d-flex">
							<div class="mx-2">
								<img src="{{ asset('public/images/icons/icon-header-01.png') }}" class="header-icon1" alt="ICON" height="60">
							</div>
							<div class="mx-2">
								<div class="mb-3">
									<label class="d-block">Kit Boxe Muay Thai Fheras Luva Trad. Caneleira Anatômica Bandagem Bucal 10oz Preta</label>
									<label class="d-block font-weight-bold ">1 unidade - R$ 179,90</label>
								</div>
								<div>
									<b>Status: </b>
									<label class="font-weight-bold text-success">Entregue</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection