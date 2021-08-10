@extends('admin.layouts.index')

@section('title')
Sem permissão
@endsection

@section('content')
<div class="main-content">
  <section class="section p-0">
    <div class="section-header">
      <div class="col-12">
        <div class="row justify-content-center">
            <i class="mdi mdi-lock-alert mdi-48px"></i>
            <h6 class="my-auto mx-3">Você não possui permissão para acessar o conteúdo.</h6>
            <div class="col-12 d-flex justify-content-center">
              <a href="javascript:history.back()" class="btn waves-effect waves-light d-flex align-items-center">
                <i class="mdi mdi-arrow-left"></i>
                <span class="mx-2">Voltar</span>
              </a>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection