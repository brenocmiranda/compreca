@extends('cliente.layouts.index')

@section('content')
<div class="container-fluid my-5 py-4">
	<div class="col-12">
		<div class="row justify-content-center">

			<div class="col-4">
				<form method="POST" action="{{ route('processLogin.mkt') }}" autocomplete="off">
					@csrf
					<div class="col-12 mb-5 text-center">
						<h3>Entre na sua conta</h3>
					</div>

					@if(Session::has('login'))
					<p class="py-0 alert text-center text-{{ Session::get('login')['class'] }}">
						{{ Session::get('login')['mensagem'] }}
					</p>
					@endif

					@if($errors->any())
					<div class="py-0 alert text-danger text-center">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					
					<div class="col-12">
						<div class="mb-3">
							<h6 class="col-12 px-0 font-weight-bold">E-mail</h6>
							<input type="email" name="email" class="form-control my-3 border-bottom" placeholder="fulano@compreca.com.br">
						</div>
						<div class="mb-3">
							<h6 class="col-12 px-0 font-weight-bold">Password</h6>
							<input type="password" name="password" class="form-control my-3 border-bottom" placeholder="********">
						</div>
					</div>
					<div class="col-12">
						<a href="">Esqueceu sua senha?</a>
					</div>
					<div class="text-center mt-5">
						<button class="col-4 size2 bg4 hov1 m-text3 trans-0-4">Entrar</button>
					</div>
				</form>
			</div>
			
			<span class="linedivide1 bg-muted" style="height: auto"></span>

			<div class="col-4 my-auto">
				<a href="{{route('cadastro.mkt')}}" class="animsition-link" data-animsition-out-class="fade-out-right"data-animsition-out-duration="2000">
					<div class=" text-center">
						<i class="mdi mdi-view-grid-plus-outline mdi-48px"></i>
					</div>
					<div class="col-12 mb-4 text-center">
						<h3>Cadastre-se já <i class="mdi mdi-arrow-right"></i></h3>
					</div>
					<div class="col-12 text-center">
						<label class="mb-0">Não possui cadastro ainda? Cadastre-se em alguns minutos e comece já a fazer suas compras por toda nossa plataforma.</label>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('support')
<script type="text/javascript">
$(document).ready(function() {
  $(".animsition-link").animsition({
    inClass: 'fade-in-left-sm',
    outClass: 'fade-out-left-sm',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    loading: true,
    loadingParentElement: 'body',
    loadingClass: 'animsition-loading',
    loadingInner: '', 
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
});
</script>
@endsection