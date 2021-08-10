@extends('cliente.layouts.index')

@section('content')
<div class="container my-4">
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
					<h4>Meus favoritos</h4>
					<hr class="col-12">
				</div>
				<div class="row mx-auto">
					@if(!empty(Auth::user()->RelationFavoritos[0]))
						@foreach(Auth::user()->RelationFavoritos as $favoritos)
						<div class="px-2" style="width: 75vw;max-width: 250px;">
							<div class="card text-center shadow-sm">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<div class="row mx-auto">
										<div class="col-12 mt-2 text-right position-absolute">
											<a href="javascript:void(0)" onclick="removerFavorito({{$favoritos->id}})" title="Remover dos seus favoritos">
												<i class="mdi mdi-close mdi-18px" aria-hidden="true"></i>
											</a>
										</div>
										<div class="img-slider mx-auto p-3" style="background-image: url('{{asset('storage/app').'/'.$favoritos->RelationProdutos->RelationImagensPrincipal->first()->caminho}}');); height: 152px; width: 152px">
										</div>
									</div>
								</div>
								
								<div class="text-left block2-txt p-3">
									<div href="" class="block2-name dis-block s-text3 pb-4" title="{{$favoritos->RelationProdutos->nome}}">
										<label class="product-text">{{$favoritos->RelationProdutos->nome}}</label>
									</div>
									<h6 class="block2-price text-dark">
										@if($favoritos->RelationProdutos->preco_promocional)
											<b>R$ {{number_format($favoritos->RelationProdutos->preco_promocional,2,",",".")}}</b>
											<label class="mb-0"><small class="text-danger" style="text-decoration: line-through">R$ {{number_format($favoritos->RelationProdutos->preco_venda,2,",",".")}}</small></label>
										@else
											R$ {{number_format($favoritos->RelationProdutos->preco_venda,2,",",".")}}
										@endif
									</h6>
									<small>
										até 12x de <b>R$ {{number_format($favoritos->RelationProdutos->preco_venda/12,2,",",".")}}</b> s/ juros
									</small>
									
									<div class="col-10 mx-auto mt-4">
										<a href="{{url('produto/'.$favoritos->RelationProdutos->cod_sku)}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4"> Compre agora </a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@else
					<div class="text-center mb-4">
						<span>Você não possui nenhum produto salvo!</span>
					</div>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('support')
<script type="text/javascript">
	function removerFavorito(id){
        swal({
          title: "Tem certeza que retirar dos seus favoritos?",
          icon: "warning",
          buttons: ["Não, cancelar", "Remover"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "favoritos/remover/"+id,
                type: 'GET',
                processData: true,
                "async": true,
                "crossDomain": true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data){
                    location.reload();
                }
            });
          } else {
            swal.close();
          }
        });
    }
</script>
@endsection