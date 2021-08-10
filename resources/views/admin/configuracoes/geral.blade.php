@extends('admin.layouts.index')

@section('title')
Configurações
@endsection

@section('content')
<div class="main-content">
  <section class="section p-0">
    <div class="section-header">
        <div class="mx-3">
            <h1>Configurações</h1>  
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                  <a href="{{route('configuracoes')}}">Configurações</a>
                </div>
                <div class="breadcrumb-item active">
                  <a href="javascript:void(0)">Ver todos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              
              <div class="row mx-5 align-items-center">
                <div class="border rounded col-5 m-3 shadow-sm">
                  <a href="{{route('configuracoes.geral')}}" class="d-flex text-decoration-none">
                    <div class="d-flex px-4 py-3">
                      <div class="col-2">
                        <i class="mdi mdi-home-outline mdi-36px"></i>
                      </div>
                      <div class="col-10">
                        <h6>Geral</h6>
                        <label class="text-dark mb-0">Gerencie as informações básicas que estão visíveis aos seus clientes.</label>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="border rounded col-5 m-3 shadow-sm">
                  <a href="{{route('configuracoes.integracoes')}}" class="d-flex text-decoration-none">
                    <div class="d-flex px-4 py-3">
                      <div class="col-2">
                        <i class="mdi mdi-minus-network-outline mdi-36px"></i>
                      </div>
                      <div class="col-10">
                        <h6>Integrações</h6>
                        <label class="text-dark mb-0">Configure as integrações que a nossa platoforma oferece.</label>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="border rounded col-5 m-3 shadow-sm">
                  <a href="{{route('configuracoes.usuarios')}}" class="d-flex text-decoration-none">
                    <div class="d-flex px-4 py-3">
                      <div class="col-2">
                        <i class="mdi mdi-account-multiple-outline mdi-36px"></i>
                      </div>
                      <div class="col-10">
                        <h6>Usuários</h6>
                        <label class="text-dark mb-0">Administre os seus funcionários que terão acesso a plataforma.</label>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('support')
<script type="text/javascript">
  $(document).ready(function (){

  });
</script>
@endsection