@extends('cliente.layouts.index')

@section('content')
<div class="container my-4">
	<div class="col-12">
		<div class="row">

			<div class="col-3">
				@include('cliente.me.leftbar')
			</div>

			<!-- Meus Pedidos -->
			<div class="col-9 p-4" id="pedidos">
				<div class="row mb-4">
					<h4>Avaliações</h4>
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
			</div>
			<!-- Meus Pedidos -->
		</div>
	</div>


</div>
@endsection