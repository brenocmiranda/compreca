@section('title')
Redefinição de Senha
@endsection

@include('admin.layouts.header')
<div id="app" class="min-vh-100">
	<section class="h-100">
		<div class="position-absolute w-100 vh-100 m-0" style="z-index: -1">
	      <div class="d-flex h-100">
	          <img src="{{ asset('public/admin/img/wallpaperleft.svg') }}" width="450" class="mr-auto mt-auto">
	          <img src="{{ asset('public/admin/img/wallpaperright.svg') }}" width="450" class="ml-auto mt-auto">
	      </div>
	    </div>

		<div class="absolute-center text-center m-auto" style="width: 500px !important;">
		
			<div class="py-4">
	          <img src="{{ asset('public/admin/img/logo.png') }}" alt="logo" width="250">
	        </div>

			<div class="text-dark px-5">
				<div class="card shadow">
					<div class="card-header">
						<h5 class="mx-auto my-auto">Redefinição de senha</h5>
					</div>
					<div class="card-body text-left">
						<div id="err"></div>
						<div class="carregamento"></div>
						<form method="POST" enctype="multipart/form-data" action="{{route('alterando.password')}}">
							@csrf
							<div class="text-center mx-3">
								<img class="col-4 rounded-circle mb-2" src="{{ asset('storage/app/'.'/'.$user->RelationImagens->caminho) }}">
								<h6 class="my-2">Olá, {{ $user->nome }}!</h6>
								<label>Para prosseguir na redefinição de senha preencha os campos abaixo com a sua nova senha que deverá conter números, letras e caracteres especiais.</label>
							</div>
							<div class="col-12 my-3">
								<label><b>Nova senha:</b></label>
								<input type="password" class="password form-control" placeholder="******" name="password" minlength="6">
							</div>
							<div class="col-12 my-3">
								<label><b>Confirme senha:</b></label>
								<input type="password" class="confirmpassword form-control" placeholder="******" name="confirmpassword" minlength="6">
								<input type="hidden" name="id" value="{{$user->id}}">
							</div>
							<div class="col-12 mt-4 mb-3 text-center">
								<button type="submit" class="btn btn-secondary col-5 mx-1 shadow-none" id="submit" disabled>Alterar</button>
							</div>
							
						</form>
					</div>
				</div>

				<div class="text-center mt-2 text-small pt-4">
		          Copyright &copy; CompreCá MarketPlace.
			        <div class="mt-2">
			          	<a href="{{ route('login') }}">Login</a>
			            <div class="bullet"></div>
			            <a href="#">Políticas de Privacidade</a>
			            <div class="bullet"></div>
			            <a href="#">Termos de serviço</a>
			        </div>
		        </div>
			</div>
		</div>
	</div>
</section>
</div>
@include('admin.layouts.footer')

<script type="text/javascript">
	$(document).ready(function (){
		$('.password, .confirmpassword').on('keyup', function(){
			if($('.password').val() == $('.confirmpassword').val()){
				if($('.password').val().length >= 6 && $('.confirmpassword').val().length >= 6){
					$('#submit').removeAttr('disabled');
					$('#submit').addClass('btn-success');
				}
			}else{
				$('#submit').attr('disabled', 'disabled');
				$('#submit').removeClass('btn-success');
			}
		});
	});
</script>