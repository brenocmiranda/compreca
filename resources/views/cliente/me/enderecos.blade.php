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
			<div class="col-9 p-4" id="enderecos">
				<div class="row mb-4">
					<h4>Meus endereços</h4>
					<hr class="col-12">
				</div>
				
				<div class="row mx-auto">
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
					@if(!empty(Auth::user()->RelationEnderecos))
						@foreach(Auth::user()->RelationEnderecos as $endereco)
						<div class="col-6 mb-4">
							<div class="p-3 border rounded {{($endereco->status == 1 ? 'border-dark' : '')}}">
								<div class="row m-auto">
									<div class="mr-auto my-auto">
										<h6>{{$endereco->nome}}</h6>
									</div>
									<div class="ml-auto">
										<a href="javascript:void(0)" class="btn-edit" onclick="editarEndereco({{$endereco->id}})">
											<i class="mdi mdi-pencil mdi-24px"></i> 
										</a>
										<a href="javascript:void(0)" class="btn-remove" onclick="removerEndereco({{$endereco->id}})">
											<i class="mdi mdi-close mdi-24px"></i>
										</a>
									</div>
								</div>
								<hr class="mt-2">
								<p class="mt-3" style="line-height: 10px">
									<label class="d-block">{{$endereco->endereco}}, {{$endereco->numero.(isset($endereco->complemento) ? ' - '.$endereco->complemento : '')}}</label>
									<label class="d-block">{{substr($endereco->cep, 0, 5).'-'.substr($endereco->cep, 5, 7)}} - {{$endereco->bairro}}</label>
									<label class="d-block">{{$endereco->cidade}} - {{$endereco->estado}}</label>
									<label class="d-block">{{$endereco->destinatario}}</label>	
								</p>
								<hr>
								<div class="mx-3 form-check">
									<a href="javascript:void(0)" {{($endereco->status != 1 ? 'onclick=alterarPrincipal('.$endereco->id.')' : '')}} >
										<input class="form-check-input" type="radio" name="status" id="defaultCheck{{$endereco->id}}" {{($endereco->status == 1 ? 'checked' : '')}}>
										<label class="form-check-label px-2" for="defaultCheck{{$endereco->id}}">
											Selecionar como principal
										</label>
									</a>
								</div>	
							</div>				
						</div>
						@endforeach
					@else
					<div class="text-center mb-4">
						<span>Você não possui nenhum endereço cadastrado!</span>
					</div>
					@endif
					<div class="col-12 text-center mt-4">
						<a href="javascript:void(0)" class="newButton col-5 size2 bg4 hov1 m-text3 trans-0-4 row align-items-center justify-content-center m-auto"> <i class="mdi mdi-plus mdi-24px px-2"></i>Adicionar novo</a>
					</div>
				</div>
			</div>

			<div class="col-9 p-4" id="newEndereco" style="display: none">
				<div class="row">
					<h4>
						<a href="javascript:void(0)" class="backButton">
							<i class="mdi mdi-arrow-left mdi-24px pr-3"></i>
						</a>
						<span class="title">Adicionar endereço de entrega</span>
					</h4>
					<hr class="col-12">
				</div>
				<div class="row mx-auto">
					<form method="POST" action="{{ route('adicionarEnderecos.mkt') }}" autocomplete="off" class="col-12">
						@csrf
						<div class="col-11 mx-auto my-2">
							<div class="col-10 mb-2">
								<label class="px-0 font-weight-bold">Nome do destinatário <i class="text-danger">*</i></label>
								<input type="text" name="destinatario" class="destinatario form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
							</div>
							<div class="col-6 mb-2">
								<label class="px-0 font-weight-bold">Tipo de endereço <i class="text-danger">*</i></label>
								<select class="nome form-control border-top-0 border-left-0 border-right-0" name="nome" required>
									<option></option>
									<option value="Apartamento">Apartamento</option>
									<option value="Casa">Casa</option>
									<option value="Comercial">Comercial</option>
									<option value="1">Outro</option>
								</select>
							</div>
							<div class="d-none nomeOutro col-6 mb-2">
								<label class="px-0 font-weight-bold">qual? <i class="text-danger">*</i></label>
								<input type="text" name="nomeOutro" class="nomeOutro form-control border-bottom">
							</div>
							<div class="col-6 mb-2">
								<label class="px-0 font-weight-bold">CEP <i class="text-danger">*</i></label>
								<input type="text" name="cep" class="cep form-control border-bottom" required>
								<div class="error"></div>
							</div>
							<div class="enderecoCEP d-none">
								<div class="row col">
									<div class="col-8 mb-2">
										<label class="px-0 font-weight-bold">Endereço <i class="text-danger">*</i></label>
										<input type="text" name="endereco" class="endereco form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
									</div>
									<div class="col-4 mb-2">
										<label class="px-0 font-weight-bold">Número <i class="text-danger">*</i></label>
										<input type="text" name="numero" class="numero form-control border-bottom" required>
									</div>
								</div>
								<div class="col-8 mb-2">
									<label class="px-0 font-weight-bold">Complemento</label>
									<input type="text" name="complemento" class="complemento form-control border-bottom" placeholder="Ex. bloco, apt, casa, fundos, sobrado etc." onkeyup="this.value = this.value.toUpperCase();">
								</div>
								<div class="col-8 mb-2">
									<label class="px-0 font-weight-bold">Informações de referência <i class="text-danger">*</i></label>
									<input type="text" name="referencia" class="referencia form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
								</div>
								<div class="col-10 mb-2">
									<label class="px-0 font-weight-bold">Bairro <i class="text-danger">*</i></label>
									<input type="text" name="bairro" class="bairro form-control border-bottom"  required>
									<input type="hidden" name="bairro1" class="bairro1" value="">
								</div>
								<div class="col-10 mb-2">
									<label class="px-0 font-weight-bold">Cidade <i class="text-danger">*</i></label>
									<input type="text" name="cidade" class="cidade form-control border-bottom" required>
									<input type="hidden" name="cidade1" class="cidade1" value="">
								</div>
								<div class="col-6 mb-2">
									<label class="px-0 font-weight-bold">Estado <i class="text-danger">*</i></label>
									<input type="text" name="estado" class="estado form-control border-bottom" required>
									<input type="hidden" name="estado1" class="estado1" value="">
								</div>
								<div class="col-12 text-center mt-5">
									<button type="submit" class="submit col-5 size2 bg4 hov1 m-text3 trans-0-4 row align-items-center justify-content-center m-auto">Adicionar endereço</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="col-9 p-4" id="editEndereco" style="display: none">
				<div class="row">
					<h4>
						<a href="javascript:void(0)" class="backButton">
							<i class="mdi mdi-arrow-left mdi-24px pr-3"></i>
						</a>
						<span>Editar endereço de entrega</span>
					</h4>
					<hr class="col-12">
				</div>
				<div class="row mx-auto">
					<form method="POST" action="{{ route('editarEnderecos.mkt') }}" autocomplete="off" class="col-12">
						@csrf
						<input type="hidden" name="id" class="id" value="">
						<div class="col-11 mx-auto my-2">
							<div class="col-10 mb-2">
								<label class="px-0 font-weight-bold">Nome do destinatário <i class="text-danger">*</i></label>
								<input type="text" name="destinatario" class="destinatario form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
							</div>
							<div class="col-6 mb-2">
								<label class="px-0 font-weight-bold">Tipo de endereço <i class="text-danger">*</i></label>
								<select class="nome form-control border-top-0 border-left-0 border-right-0" name="nome" required>
									<option></option>
									<option value="Apartamento">Apartamento</option>
									<option value="Casa">Casa</option>
									<option value="Comercial">Comercial</option>
									<option value="1">Outro</option>
								</select>
							</div>
							<div class="d-none nomeOutro col-6 mb-2">
								<label class="px-0 font-weight-bold">qual? <i class="text-danger">*</i></label>
								<input type="text" name="nomeOutro" class="nomeOutro form-control border-bottom">
							</div>
							<div class="col-6 mb-2">
								<label class="px-0 font-weight-bold">CEP <i class="text-danger">*</i></label>
								<input type="text" name="cep" class="cep form-control border-bottom" required>
								<div class="error"></div>
							</div>
							<div class="enderecoCEP d-none">
								<div class="row col">
									<div class="col-8 mb-2">
										<label class="px-0 font-weight-bold">Endereço <i class="text-danger">*</i></label>
										<input type="text" name="endereco" class="endereco form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
									</div>
									<div class="col-4 mb-2">
										<label class="px-0 font-weight-bold">Número <i class="text-danger">*</i></label>
										<input type="text" name="numero" class="numero form-control border-bottom" required>
									</div>
								</div>
								<div class="col-8 mb-2">
									<label class="px-0 font-weight-bold">Complemento</label>
									<input type="text" name="complemento" class="complemento form-control border-bottom" placeholder="Ex. bloco, apt, casa, fundos, sobrado etc." onkeyup="this.value = this.value.toUpperCase();">
								</div>
								<div class="col-8 mb-2">
									<label class="px-0 font-weight-bold">Informações de referência <i class="text-danger">*</i></label>
									<input type="text" name="referencia" class="referencia form-control border-bottom" onkeyup="this.value = this.value.toUpperCase();" required>
								</div>
								<div class="col-10 mb-2">
									<label class="px-0 font-weight-bold">Bairro <i class="text-danger">*</i></label>
									<input type="text" name="bairro" class="bairro form-control border-bottom"  required>
									<input type="hidden" name="bairro1" class="bairro1" value="">
								</div>
								<div class="col-10 mb-2">
									<label class="px-0 font-weight-bold">Cidade <i class="text-danger">*</i></label>
									<input type="text" name="cidade" class="cidade form-control border-bottom" required>
									<input type="hidden" name="cidade1" class="cidade1" value="">
								</div>
								<div class="col-6 mb-2">
									<label class="px-0 font-weight-bold">Estado <i class="text-danger">*</i></label>
									<input type="text" name="estado" class="estado form-control border-bottom" required>
									<input type="hidden" name="estado1" class="estado1" value="">
								</div>
								<div class="col-12 text-center mt-5">
									<button type="submit" class="submit col-5 size2 bg4 hov1 m-text3 trans-0-4 row align-items-center justify-content-center m-auto">Salvar alterações</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('support')
<script type="text/javascript">
	function editarEndereco(id){
        $.ajax({
            url: "enderecos/detalhes/"+id,
            type: 'GET',
            processData: true,
            "async": true,
            "crossDomain": true,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data){
            	$('#enderecos').fadeOut();
				$('#editEndereco').fadeIn();
				$('.enderecoCEP').removeClass('d-none');
				$('.id').val(data.id);
				$('.destinatario').val(data.destinatario);
				if(data.outros == 1){
					$('.nome').val(1);
					$('.nomeOutro').removeClass('d-none');
				}else{
					$('.nomeOutro').addClass('d-none');
					$('.nome').val(data.nome);
				}
				$('.nomeOutro').val(data.nome);
				$('.cep').val(data.cep.substr(0, 5)+'-'+data.cep.substr(5, 7));
				$('.endereco').val(data.endereco);
				$('.numero').val(data.numero);
				$('.complemento').val(data.complemento);
				$('.referencia').val(data.referencia);
				$('.bairro').val(data.bairro);
				$('.bairro').attr('disabled', 'disabled');
				$('.bairro1').val(data.bairro);
				$('.cidade').val(data.cidade);
				$('.cidade').attr('disabled', 'disabled');
				$('.cidade1').val(data.cidade);
				$('.estado').val(data.estado);
				$('.estado').attr('disabled', 'disabled');
				$('.estado1').val(data.estado);
				console.log(data);
            }
        });  
    }

	function alterarPrincipal(id){
        swal({
          title: "Tem certeza que deseja alterar o seu endereço principal?",
          icon: "warning",
          buttons: ["Não, cancelar", "Alterar"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "enderecos/alterar/"+id,
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

    function removerEndereco(id){
        swal({
          title: "Tem certeza que remover esse endereço?",
          icon: "warning",
          buttons: ["Não, cancelar", "Excluir"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "enderecos/remover/"+id,
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
	$(document).ready(function (){
		// Mascaras
		$('.cep').mask('00000-000');

		// Colocando o nome do novo endereço
		$('.nome').on('change', function(){
			if(this.value == 1){
				$('.nomeOutro input').val('');
				$('.nomeOutro').removeClass('d-none');
			}else{
				$('.nomeOutro').addClass('d-none');
				$('.nomeOutro input').val(this.value);
			}
		});

		// Mostrando informações para novo endereço
		$('.newButton').on('click', function(e){
			$('#enderecos').fadeOut();
			$('#newEndereco').fadeIn();
		});

		// Mostrando todos os endereços
		$('.backButton').on('click', function(e){
			$('#newEndereco').fadeOut();
			$('#editEndereco').fadeOut();
			$('#enderecoCEP').addClass('d-none');
			$('#enderecos').fadeIn();
			$('form')[0].reset();
		});

		// Capturando informações de CEP
		$(".cep").on('keyup', function(e){
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+cep+"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            $(".enderecoCEP .error").html('');
                            $('.enderecoCEP').removeClass('d-none');
                            //Atualiza os campos com os valores da consulta.
                            if(dados.logradouro){
                             	$('.enderecoCEP .endereco').val(dados.logradouro.toUpperCase());
                            }
                            if(dados.localidade){
                                $('.enderecoCEP .cidade').attr('disabled', 'disabled');
                                $('.enderecoCEP .cidade').val(dados.localidade.toUpperCase());
                                $(".enderecoCEP .cidade1").val(dados.localidade.toUpperCase());
                            }else{
                                $(".enderecoCEP .cidade").removeAttr('disabled');
                            }
                            if(dados.uf){
                                $(".enderecoCEP .estado").attr('disabled', 'disabled');
                                $(".enderecoCEP .estado").val(dados.uf.toUpperCase());
                                $(".enderecoCEP .estado1").val(dados.uf.toUpperCase());
                            }else{
                                $(".enderecoCEP .estado").removeAttr('disabled');
                            }
                            if(dados.bairro){
                                $(".enderecoCEP .bairro").attr('disabled', 'disabled');
                                $(".enderecoCEP .bairro").val(dados.bairro.toUpperCase());
                                $(".enderecoCEP .bairro1").val(dados.bairro.toUpperCase());
                            }else{
                                $(".enderecoCEP .bairro").removeAttr('disabled');
                            }

                        }else {
                            //CEP pesquisado não foi encontrado.
                            $(".enderecoCEP .error").html('O seu CEP não pode ser encontrado!');
                        }
                    });
                } else {
                    //cep é inválido.
                    $(".enderecoCEP .error").html('O seu CEP é inválido!')
                }
            }else {
                //cep sem valor, limpa formulário.
                $(".enderecoCEP .cidade").val('');
                $(".enderecoCEP .estado").val('');
                $(".enderecoCEP .cidade").val('');
                $(".enderecoCEP .cep").val('');
                $(".enderecoCEP .error").html('');
            }
        });
	});
</script>
@endsection