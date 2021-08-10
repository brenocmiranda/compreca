<ul class="mt-4">
	<li class="my-1 {{(Request::segment(2) == 'pedidos' ? 'sale-noti' : '')}}">
		<a href="{{route('pedidos.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-cube-outline mdi-36px"></span>
			<h6 class="my-auto px-2"> Pedidos</h6>
		</a>
	</li>
	<li class="my-1 {{(Request::segment(2) == 'perfil' ? 'sale-noti' : '')}}">
		<a href="{{route('perfil.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-account mdi-36px"></span>
			<h6 class="my-auto px-2"> Cadastro</h6>
		</a>
	</li>
	<li class="my-1 {{(Request::segment(2) == 'enderecos' ? 'sale-noti' : '')}}">
		<a href="{{route('enderecos.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-map-marker mdi-36px"></span>
			<h6 class="my-auto px-2"> Endereços</h6>
		</a>
	</li>
	<li class="my-1 {{(Request::segment(2) == 'favoritos' ? 'sale-noti' : '')}}">
		<a href="{{route('favoritos.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-star mdi-36px"></span>
			<h6 class="my-auto px-2"> Favoritos</h6>
		</a>
	</li>
	<li class="my-1 {{(Request::segment(2) == 'avaliacoes' ? 'sale-noti' : '')}}">
		<a href="{{route('avaliacoes.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-flag-outline mdi-36px"></span>
			<h6 class="my-auto px-2"> Avaliações</h6>
		</a>
	</li>
	<li class="my-1 {{(Request::segment(2) == 'duvidas' ? 'sale-noti' : '')}}">
		<a href="{{route('duvidas.mkt')}}" class="d-flex align-items-center">
			<span class="mdi mdi-help-circle-outline mdi-36px"></span>
			<h6 class="my-auto px-2"> Dúvidas</h6>
		</a>
	</li>
	<hr>
	<li class="my-1 bg-light px-2 rounded">
		<a href="#" class="d-flex align-items-center">
			<span class="mdi mdi-swap-horizontal mdi-36px"></span>
			<h6 class="my-auto px-2"> Trocar ou Devolver</h6>
		</a>
	</li>
	<li class="my-1 bg-light px-2 rounded">
		<a href="#" class="d-flex align-items-center">
			<span class="mdi mdi-comment-multiple-outline mdi-36px"></span>
			<h6 class="my-auto px-2"> Preciso de ajuda</h6>
		</a>
	</li>
	<li class="my-1 bg-light px-2 rounded">
		<a href="#" class="d-flex align-items-center">
			<span class="mdi mdi-phone mdi-36px"></span>
			<h6 class="my-auto px-2"> Fale com a gente</h6>
		</a>
	</li>
</ul>