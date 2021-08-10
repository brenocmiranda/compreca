@section('title')
Cadastro
@endsection

@include('cliente.layouts.header')	
<div class="container-menu-header position-relative">
	<div class="wrap_header fixed-top" style="background-color: #fad70a!important">
		<a href="{{ route('home.mkt') }}" class="logo">
			<img src="<x-logomarca/>" alt="Logomarca">
		</a>
		<div class="header-icons">
			<a href="{{ route('home.mkt') }}" class="text-dark">Página Inicial</a>
			<span class="linedivide1 bg-secondary"></span>
			<a href="{{ route('login.mkt') }}" class="text-dark">Já possui cadastro? Entre</a>
		</div>
	</div>
</div>

<div class="container-fluid mb-5" style="margin-top: 120px">
	<div class="col-12">
		<div class="row justify-content-center">
			<div class="col-7">
				<form method="POST" action="{{ route('processCadastro.mkt') }}" autocomplete="off">
					@csrf
					<div class="col-12 mb-5 text-center">
						<h3 class="mb-2">
							<i class="mdi mdi-account-outline mdi-36px"></i>
							<span>Cadastre-se</span>
						</h3>
						<label>Preencha as informações necessárias do formulário e siga com suas compras</label>
						<hr class="mx-5">
					</div>

					@if(Session::has('login'))
					<p class="py-0 alert text-{{ Session::get('login')['class'] }}">
						{{ Session::get('login')['mensagem'] }}
					</p>
					@endif
					@if($errors->any())
					<div class="py-0 alert text-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					<div class="col-8 mx-auto">
						<div class="col-12 mb-4">
							<h6 class="px-0 font-weight-bold">E-mail <i class="text-danger">*</i></h6>
							<input type="email" name="email" id="txtEmail" class="form-control my-3 border-bottom" placeholder="Ex. joaodasilva@gmail.com" required>
							<div id="validaEmail"></div>
						</div>

						<div class="col-8 mb-4">
							<h6 class="px-0 font-weight-bold">Senha <i class="text-danger">*</i></h6>
							<div class="input-group">
								<input type="password" name="password" id="txtPassword" class="form-control my-3 border-bottom" required>
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

						<div class="mb-4 row mx-auto">
							<div class="form-group col-12">
								<h6 class="px-0 font-weight-bold">Voce é? <i class="text-danger">*</i></h6>
							</div>
							<div class="row col-8">
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="tipo" value="pf" id="defaultCheck1" checked>
									<label class="form-check-label px-2" for="defaultCheck1">
										Pessoa física
									</label>
								</div>
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="tipo" value="pj" id="defaultCheck2">
									<label class="form-check-label px-2" for="defaultCheck2">
										Pessoa jurídica
									</label>
								</div>
							</div>
						</div>

						<div class="mb-4 col-7">
							<h6 class="px-0 font-weight-bold">Documento <small class="doc">CPF</small> <i class="text-danger">*</i></h6>
							<input type="text" name="documento" id="txtDocumento" class="documento form-control my-3 border-bottom" placeholder="Ex. 000.000.000-00" required>
							<div class="text-danger" id="validaDocumento"></div>
						</div>

						<div class="mb-4 col-12">
							<h6 class="px-0 font-weight-bold">Nome completo <i class="text-danger">*</i></h6>
							<input type="text" name="nome" class="form-control my-3 border-bottom" placeholder="Ex. João da Silva" required>
						</div>

						<div class="mb-4 col-6">
							<h6 class="px-0 font-weight-bold">Data de nascimento</h6>
							<input type="date" name="data_nascimento" class="form-control my-3 border-bottom" placeholder="Ex. 01/10/1995">
						</div>

						<div class="mb-4 row mx-auto">
							<div class="form-group col-12">
								<h6 class="px-0 font-weight-bold">Sexo <i class="text-danger">*</i></h6>
							</div>
							<div class="row col-8">
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="sexo" value="M" id="defaultCheck3" checked>
									<label class="form-check-label px-2" for="defaultCheck3">
										Masculino
									</label>
								</div>
								<div class="mx-3 form-check">
									<input class="form-check-input" type="radio" name="sexo" value="F" id="defaultCheck4">
									<label class="form-check-label px-2" for="defaultCheck4">
										Feminino
									</label>
								</div>
							</div>
						</div>

						<div class="mb-4 col-7">
							<h6 class="px-0 font-weight-bold">Telefone <i class="text-danger">*</i></h6>
							<input type="tel" name="telefone" class="telefone form-control my-3 border-bottom" placeholder="(38) 91234-5678" required>
						</div>

						<div class="m-4 col-8 form-check">
							<input class="form-check-input" type="checkbox" name="whatsapp" id="defaultCheck5">
							<label class="form-check-label" for="defaultCheck5">
								Receber notificações por whatsapp.
								<span class="element" data-toggle="tooltip" data-placement="right" title="Você receberá uma mensagem a cada atualização do seu pedido, desde a confirmação de compra até a entrega.">
								  <i class="mdi mdi-information-outline mdi-18px"></i>
								</span>
							</label>
						</div>

						<div class="m-4 col-8 form-check">
							<input class="form-check-input" type="checkbox" name="leads" id="defaultCheck6" checked>
							<label class="form-check-label" for="defaultCheck6">
								Desejo receber ofertas por e-mail.
							</label>
						</div>

						
					</div>

					<div class="text-center mt-5">
						<button type="submit" class="submit col-5 size2 bg4 hov1 m-text3 trans-0-4">Criar seu cadastro</button>
					</div>
					<div class="my-4 text-center">
						<a href="{{ route('login.mkt') }}" class="mx-2">Já possui um cadastro? Entre</a>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

@section('support')
<script type="text/javascript">
    $(document).ready(function (){

    	$('.element').tooltip();

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
       
        // Mascaras
        $('.documento').mask('000.000.000-00', {reverse: true});
        $('.telefone').mask('(00) 00000-0000');

        // Seleção por tipo de cadastro
        $('input[name="tipo"]').on('change', function(){
        	if(this.value == 'pf'){
        		$('.doc').html('CPF');
        		$('.documento').attr('placeholder', 'Ex. 000.000.000-00');
        		$('.documento').mask('000.000.000-00', {reverse: true});
        	}else{
        		$('.doc').html('CNPJ');
        		$('.documento').attr('placeholder', 'Ex. 00.000.000/0000-00');
        		$('.documento').mask('00.000.000/0000-00', {reverse: true});
        	}
        });

        // Validando o e-mail
        $('#txtEmail').on('change', function(e){
	        e.preventDefault();
	        if(this.value != null){
		        $.ajax({
		            url: 'cadastrar/vEmail/'+this.value,
		            type: 'GET',
		            success: function(data){
		            	if(data.valid == true){
		            		$('#validaEmail').html('<label class="alert alert-danger col-12">E-mail já cadastrado! <a href="{{route("login.mkt")}}" target="_blank">Faça seu login.</a></label>');
		            		$('.submit').attr('disabled', 'disabled');
		            		$('.submit').removeClass('hov1');
		            		$('.submit').addClass('bg-danger');
		            	}else{
		            		$('.submit').addClass('hov1');
		            		$('.submit').removeClass('bg-danger');
		            		$('.submit').removeAttr('disabled');
		            		$('#validaEmail').html('');
		            	}
		            }
		        });
	        }
	    });

	    // Validando o documento
        $('#txtDocumento').on('change', function(e){
	        e.preventDefault();
	        if(this.value != null){
		        $.ajax({
		            url: 'cadastrar/vDoc/'+this.value,
		            type: 'GET',
		            success: function(data){
		            	if(data.valid == true){
		            		$('#validaDocumento').html('<label class="alert alert-danger col-12">Documento já cadastrado!</label>');
		            		$('.submit').attr('disabled', 'disabled');
		            		$('.submit').removeClass('hov1');
		            		$('.submit').addClass('bg-danger');
		            	}else{
		            		$('#validaDocumento').html('');
		            		$('.submit').addClass('hov1');
		            		$('.submit').removeClass('bg-danger');
		            		$('.submit').removeAttr('disabled');
		            		
		            	}
		            }
		        });
	        }
	    });
   	});
</script>
@endsection

@include('cliente.layouts.footer')