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
					<h4>Minha conta</h4>
					<hr class="col-12">
				</div>
				<form method="POST" action="{{ route('salvarPerfil.mkt', Auth::id()) }}" autocomplete="off">
					@csrf
					<div class="row col-12">
						@if($errors->any())
						<div class="col-12 mb-4 alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						@if(Session::has('confirm'))
						<p class="col-12 mb-4 alert alert-{{ Session::get('confirm')['class'] }}">
							{{ Session::get('confirm')['mensagem'] }}
						</p>
						@endif
					
						<div class="col-8 mb-2">
							<h6 class="px-0 font-weight-bold">Nome completo <i class="text-danger">*</i></h6>
							<input type="text" name="nome" class="form-control my-3 border-bottom" value="{{Auth::user()->nome}}" placeholder="Ex. João da Silva" required>
						</div>

						<div class="col-4 mb-2">
							<h6 class="px-0 font-weight-bold">Apelido</h6>
							<input type="text" name="apelido" class="form-control my-3 border-bottom" value="{{Auth::user()->apelido}}" placeholder="Ex. João">
						</div>

						<div class="col-8 mb-2">
							<h6 class="px-0 font-weight-bold">E-mail <i class="text-danger">*</i></h6>
							<input type="email" name="email1" id="txtEmail" class="form-control my-3 border-bottom" value="{{Auth::user()->email}}" placeholder="Ex. joaodasilva@gmail.com" disabled>
							<div id="validaEmail"></div>
							<input type="hidden" name="email" value="{{Auth::user()->email}}">
						</div>

						<div class="row mb-2 col-12">
							<div class="col-6">
								<h6 class="px-0 font-weight-bold">Documento <small class="doc">{{(Auth::user()->tipo == 'pf' ? 'CPF' : 'CNPJ')}}</small> <i class="text-danger">*</i></h6>
								<input type="hidden" name="tipo" value="{{Auth::user()->tipo}}">
								<input type="text" name="documento" id="txtDocumento" class="documento form-control my-3 border-bottom" placeholder="{{(Auth::user()->tipo == 'pf' ? 'Ex. 000.000.000-00' : 'Ex. 00.000.000/0000-00')}} " value="{{Auth::user()->documento}}" required>
								<div class="text-danger" id="validaDocumento"></div>
							</div>
							<div class="col-6">
								<h6 class="px-0 font-weight-bold">Data de nascimento</h6>
								<input type="date" name="data_nascimento" class="form-control my-3 pt-1 border-bottom" value="{{Auth::user()->data_nascimento}}" placeholder="Ex. 01/10/1995">
							</div>
						</div>

						<div class="col-12 row mb-4">
							<div class="form-group col-12">
								<h6 class="px-0 font-weight-bold">Sexo <i class="text-danger">*</i></h6>
							</div>
							<div class="row col-8">
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="sexo" value="M" id="defaultCheck3"  {{(Auth::user()->sexo == "M" ? 'checked' : '')}}>
									<label class="form-check-label px-2" for="defaultCheck3">
										Masculino
									</label>
								</div>
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="sexo" value="F" id="defaultCheck4" {{(Auth::user()->sexo == "F" ? 'checked' : '')}}>
									<label class="form-check-label px-2" for="defaultCheck4">
										Feminino
									</label>
								</div>
							</div>
						</div>

						<div class="row mb-4 col-12">
							<div class="col-6">
								<h6 class="px-0 font-weight-bold">Telefone de contato <i class="text-danger">*</i></h6>
								<input type="tel" name="telefone" class="telefone form-control my-3 border-bottom" placeholder="(38) 91234-5678" value="{{(isset(Auth::user()->RelationTelefones) ? str_replace('55', '', Auth::user()->RelationTelefones->tel_contato) : '')}}" required>
							</div>
							<div class="col-6">
								<h6 class="px-0 font-weight-bold">Telefone whatsapp</h6>
								<input type="tel" name="whatsapp" class="telefone form-control my-3 border-bottom" placeholder="(38) 91234-5678" value="{{(isset(Auth::user()->RelationTelefones) ? str_replace('55', '', Auth::user()->RelationTelefones->tel_whatsapp) : '')}}">
							</div>
						</div>

						<div class="form-group col-12">
							<h6>
								<a href="javascript:void(0)" id="alterarSenha" class="btn shadow-none">Alterar senha <i class="fa fa-caret-down"></i>
								</a>
							</h6>
						</div> 

						<div class="p-3 col-12 row alterarSenha d-none">
							<div class="col-6 mb-4">
								<h6 class="px-0 font-weight-bold">Senha <i class="text-danger">*</i></h6>
								<div class="input-group">
									<input type="password" name="senha" id="txtPassword" class="senha form-control my-3 border-bottom" autofocus autocomplete="off" readonly onfocus="this.removeAttribute('readonly');this.select();">
									<div class="input-group-append my-3 border-bottom">
										<button id="passwordView"><i class="mdi mdi-eye-off-outline mdi-24px px-2"></i></button>
									</div>
								</div>
								<div class="row col-12 mx-1">
									<div class="col-6 p-0 progress">
										<div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<small class="px-3" id="mtSenhatxt"></small>
								</div>
							</div>
							<div class="col-6 mb-4">
								<h6 class="px-0 font-weight-bold">Confirme sua senha <i class="text-danger">*</i></h6>
								<div class="input-group">
									<input type="password" name="password" id="txtPassword1" class="password form-control my-3 border-bottom" autofocus autocomplete="off" readonly onfocus="this.removeAttribute('readonly');this.select();">
									<div class="input-group-append my-3 border-bottom">
										<button id="passwordView1"><i class="mdi mdi-eye-off-outline mdi-24px px-2"></i></button>
									</div>
								</div>
								<small class="coincidem"></small>
							</div>
						</div>

						<div class="col-12 text-center mt-4">
							<button type="submit" class="submit col-5 size2 bg4 hov1 m-text3 trans-0-4">Salvar alterações</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('support')
<script type="text/javascript">
	$(document).ready(function (){
		 	// Mascaras
		 	@if(Auth::user()->tipo == 'pf')
	        	$('.documento').mask('000.000.000-00', {reverse: true});
	        @else
	       		$('.documento').mask('00.000.000/0000-00', {reverse: true});
	        @endif
	        $('.telefone').mask('(00) 00000-0000');

			// Habilitando inserção de senha manual
			$('#alterarSenha').click(function(){
				if ($('.alterarSenha').hasClass('d-none')){
					$('.alterarSenha').removeClass('d-none');
				}else{
					$('.alterarSenha').addClass('d-none');
				}
			});

            // Verificar se as senhas coincidem
            $('.senha, .password').blur(function(){
            	$('.senha').removeClass('border-danger');
            	if ($('.senha').val() == $('.password').val()){
            		$('.coincidem').html('<div class="text-success mb-2">Suas senhas estão iguais!</div>');
            		$('.submit').addClass('hov1');
            		$('.submit').removeClass('bg-danger');
            		$('.submit').removeAttr('disabled');
            	}else{
            		$('.coincidem').html('<div class="text-danger mb-2">As senhas não coincidem!</div>');
            		$('.senha').addClass('border-danger');
            		$('.submit').attr('disabled', 'disabled');
            		$('.submit').removeClass('hov1');
            		$('.submit').addClass('bg-danger');
            	}
            });

            // Complexidade de senha digitada    	
            $("#txtPassword").complexify({}, function (valid, complexity) {
            	$(".progress-bar").attr('aria-valuenow', complexity);
            	$(".progress-bar").attr('style', 'width:'+complexity+'%;');
            	if (complexity == 0) {
            		$("#mtSenhatxt").html('');
            		$(".progress-bar").removeClass('bg-danger bg-warning bg-info bg-success');
            	}else if(complexity < 30){
            		$("#mtSenhatxt").html('Fraca');
            		$(".progress-bar").removeClass('bg-danger bg-warning bg-info bg-success');
            		$(".progress-bar").addClass('bg-danger');
            	}else if(complexity > 30 && complexity < 50){
            		$("#mtSenhatxt").html('Boa');
            		$(".progress-bar").removeClass('bg-danger bg-warning bg-info bg-success');
            		$(".progress-bar").addClass('bg-warning');
            	}else if(complexity > 50 && complexity < 70){
            		$("#mtSenhatxt").html('Forte');
            		$(".progress-bar").removeClass('bg-danger bg-warning bg-info bg-success');
            		$(".progress-bar").addClass('bg-info');
            	}else if(complexity > 70){
            		$("#mtSenhatxt").html('Muito forte');
            		$(".progress-bar").removeClass('bg-danger bg-warning bg-info bg-success');
            		$(".progress-bar").addClass('bg-success');
            	}
            });

	        // Mostrando a senha
	        $('#passwordView').on('click', function(e){
	        	e.preventDefault();
	        	if($('#txtPassword').attr('type') == 'password'){
	        		$('#txtPassword').attr('type', 'text');
	        		$('#passwordView i').removeClass('mdi-eye-off-outline');
	        		$('#passwordView i').addClass('mdi-eye-outline');
	        	}else{
	        		$('#txtPassword').attr('type', 'password');
	        		$('#passwordView i').removeClass('mdi-eye-outline');
	        		$('#passwordView i').addClass('mdi-eye-off-outline');
	        	}
	        });

	        // Mostrando a senha
	        $('#passwordView1').on('click', function(e){
	        	e.preventDefault();
	        	if($('#txtPassword1').attr('type') == 'password'){
	        		$('#txtPassword1').attr('type', 'text');
	        		$('#passwordView1 i').removeClass('mdi-eye-off-outline');
	        		$('#passwordView1 i').addClass('mdi-eye-outline');
	        	}else{
	        		$('#txtPassword1').attr('type', 'password');
	        		$('#passwordView1 i').removeClass('mdi-eye-outline');
	        		$('#passwordView1 i').addClass('mdi-eye-off-outline');
	        	}
	        });
    });
</script>
@endsection