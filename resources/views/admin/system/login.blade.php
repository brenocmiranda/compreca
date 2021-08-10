@section('title')
Login
@endsection

@include('admin.layouts.header')

<div id="app" class="min-vh-100 h-100"> 
  <section class="section min-vh-100 h-100 p-0">

    <div class="position-absolute w-100 h-100 m-0" style="z-index: -1">
      <div class="d-flex h-100">
          <img src="{{ asset('public/admin/img/wallpaperleft.svg') }}" width="450" class="mr-auto mt-auto">
          <img src="{{ asset('public/admin/img/wallpaperright.svg') }}" width="450" class="ml-auto mt-auto">
      </div>
    </div>

    <div class="">
      <div class="mx-auto text-center" style="width: 400px !important;">
        <div class="py-5">
          <img src="{{ asset('public/admin/img/logo.png') }}" alt="logo" width="220">
        </div>

        <div class="p-5 bg-white border rounded mx-auto text-center justify-content-center shadow">
          <div class="pb-3">
            <h6 class="font-weight-normal">Entre para continuar em:</h6>
            <h6>Painel Administrativo</h6>
          </div>

          @if(Session::has('login'))
          <p class="py-0 alert text-{{ Session::get('login')['class'] }}">
            {{ Session::get('login')['mensagem'] }}
          </p>
          @endif

          @if ($errors->any())
          <div class="py-0 alert text-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <form method="POST" action="{{ route('redirect') }}" class="needs-validation" novalidate="" autocomplete="off">
            @csrf
            <div class="my-3">
              <input id="email" type="email" name="email" tabindex="1" placeholder="Entre com seu e-mail"  autofocus autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required>
              @if(Session::has('email'))
              <p class="text-danger text-left">{{ Session::get('email')['mensagem'] }}</p>
              @endif
            </div>
            <div class="my-3">
              <input id="password" type="password" name="password" tabindex="2" placeholder="Entre com sua senha" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required>
              @if(Session::has('password'))
              <p class="text-danger text-left">{{ Session::get('password')['mensagem'] }}</p>
              @endif
            </div>

            <div class="text-left form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                <label class="custom-control-label" for="remember-me">Relembrar</label>
              </div>
            </div>
            <div class="text-center form-group">
              <button type="submit" class="btn shadow-none col-6 rounded" tabindex="4">
                Acessar
              </button>
            </div>
          </form>
          <div class="">
            <a href="javascript:void(0)" class="recuperar" data-toggle="modal" data-target="#modal-recuperar">
              Esqueceu sua senha?
            </a>
          </div>
        </div>

        <div class="text-center py-4 text-small">
          Copyright &copy; CompreCá MarketPlace.
          <div class="mt-2">
            <a href="{{route('home.mkt')}}">Marketplace</a>
            <div class="bullet"></div>
            <a href="#">Políticas de Privacidade</a>
            <div class="bullet"></div>
            <a href="#">Termos de serviço</a>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

@include('admin.system.recuperacao')
@include('admin.layouts.footer')

<script type="text/javascript">
  $(document).ready(function (){
    $('.recuperar').on('click', function(e){
      $('#err').html('');
      $('.carregamento').html('');
      $('input[name="email"]').removeClass('border-bottom border-danger');
      $('#modal-recuperar #formRecuperar').removeClass('d-none');
    });

    // Enviando email de recuperação
    $('#modal-recuperar #formRecuperar').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route("encaminhar.password") }}',
        type: 'POST',
        data: $('#modal-recuperar #formRecuperar').serialize(),
        beforeSend: function(){
          $('input[name="email"]').removeClass('border-bottom border-danger');
          $('#err').html('');
          $('#modal-recuperar #formRecuperar').addClass('d-none');
          $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="spinner-border my-3" role="status"><span class="sr-only"> Loading... </span></div><label class="col-12">Enviando e-mail de recuperação...</label></div>');
        },
        success: function(data){
          $('.carregamento').html('<div class="mx-auto text-center my-5"><div class="col-sm-12 col-md-12 col-lg-12"><i class="col-sm-2 mdi mdi-check-all my-3 text-success" style="font-size:62px;"></i></div><h5>E-mail enviado com sucesso!</h5><label class="mx-4">Verifique o recebimento da mensagem na sua <b>caixa de entrada ou na área de spam</b>. Caso não esteja recebendo o e-mail de redefinição, entre em contato com administrador@compreca.com.br.</label><div class="col-12 mt-5 text-center"><button type="button" class="btn btn-outline-secondary shadow-none col-4" data-dismiss="modal" aria-label="Close">Fechar</button></div></div> ');
        }, error: function (data) {
          setTimeout(function(){
            $('#modal-recuperar #formRecuperar').removeClass('d-none');
            $('.carregamento').html('');
            $('#modal-recuperar #err').html('<div class="alert alert-danger mx-2">E-mail não cadastrado.</div>');
            $('#modal-recuperar input[name="email"]').addClass('border-bottom border-danger');
          }, 800);
        }
      });
    });

  });
</script>