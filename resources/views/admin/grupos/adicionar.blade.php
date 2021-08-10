@extends('admin.layouts.index')

@section('title')
Novo grupo
@endsection

@section('content')
<div class="main-content">
    <section class="section p-0">
      <div class="section-header">
            <div class="mx-3">
                <h1>Novo grupo</h1>  
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{route('exibir.usuarios')}}">Usuários</a></div>
                    <div class="breadcrumb-item"><a href="{{route('exibir.grupos')}}">Grupos</a></div>
                    <div class="breadcrumb-item active">Adicionar</div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('salvar.grupos') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="card-1">
                            <div class="card-header py-0">
                                <h5 class="section-title">Informações básicas</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    <label class="custom-switch px-0">
                                        <input type="checkbox" name="status" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"><b>Ativo</b></span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="checkbox" name="visivel" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description"><b>Visivel aos lojistas</b></span>
                                    </label>
                                </div>
                                <div class="form-group col-6">
                                    <label>Nome do grupo<i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="Administradores" required>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="card-2">
                            <div class="card-header py-0">
                                <h5 class="section-title">Permissões de acesso</h5>
                                <div class="mx-3 my-auto custom-control custom-checkbox">
                                    <input type="checkbox" name="acesso_total" class="custom-control-input" tabindex="3" id="acesso_total">
                                    <label class="custom-control-label" for="acesso_total">Acesso total</label>
                                </div>
                            </div>
                            <div class="card-body row mx-3">
                                <h6> Gerencial </h6>
                                <hr class="col-12 p-0">
                                <div class="col-12 row">
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Dashboard </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_dashboard" class="custom-control-input" tabindex="3" id="ver_dashboard">
                                            <label class="custom-control-label" for="ver_dashboard">Visualizar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Pedidos </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_pedidos" class="custom-control-input" tabindex="3" id="ver_pedidos">
                                            <label class="custom-control-label" for="ver_pedidos">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_pedidos" id="edit_pedidos" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_pedidos">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> C. abandonados </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_carrinhos" class="custom-control-input" tabindex="3" id="ver_carrinhos">
                                            <label class="custom-control-label" for="ver_carrinhos">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_carrinhos" id="edit_carrinhos" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_carrinhos">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Clientes </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_clientes" class="custom-control-input" tabindex="3" id="ver_clientes">
                                            <label class="custom-control-label" for="ver_clientes">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_clientes" id="edit_clientes" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_clientes">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Leads </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_leads" class="custom-control-input" tabindex="3" id="ver_leads">
                                            <label class="custom-control-label" for="ver_leads">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_leads" id="edit_leads" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_leads">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Marketing </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_marketing" class="custom-control-input" tabindex="3" id="ver_marketing">
                                            <label class="custom-control-label" for="ver_marketing">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_marketing" id="edit_marketing" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_marketing">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Produtos </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_produtos" class="custom-control-input" tabindex="3" id="ver_produtos">
                                            <label class="custom-control-label" for="ver_produtos">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_produtos" id="edit_produtos" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_produtos">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Categorias </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_categorias" class="custom-control-input" tabindex="3" id="ver_categorias">
                                            <label class="custom-control-label" for="ver_categorias">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_categorias" id="edit_categorias" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_categorias">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Marcas </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_marcas" class="custom-control-input" tabindex="3" id="ver_marcas">
                                            <label class="custom-control-label" for="ver_marcas">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_marcas" id="edit_marcas" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_marcas">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Variações </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_variacoes" class="custom-control-input" tabindex="3" id="ver_variacoes">
                                            <label class="custom-control-label" for="ver_variacoes">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_variacoes" id="edit_variacoes" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_variacoes">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Relatórios </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_relatorios" class="custom-control-input" tabindex="3" id="ver_relatorios">
                                            <label class="custom-control-label" for="ver_relatorios">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_relatorios" id="edit_relatorios" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_relatorios">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Configurações </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_configuracoes" class="custom-control-input" tabindex="3" id="ver_configuracoes">
                                            <label class="custom-control-label" for="ver_configuracoes">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_configuracoes" id="edit_configuracoes" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_configuracoes">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <h6> Administrativo </h6>
                                <hr class="mt-0 col-12 p-0">
                                <div class="col-12 row">
                                    <div class="form-group mb-2 col-2">
                                        <label class="font-weight-normal"> Lojas </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_lojas" class="custom-control-input" tabindex="3" id="ver_lojas">
                                            <label class="custom-control-label" for="ver_lojas">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_lojas" id="edit_lojas" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_lojas">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 col-2">
                                        <label class="font-weight-normal"> Instituições </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_instituicoes" class="custom-control-input" tabindex="3" id="ver_instituicoes">
                                            <label class="custom-control-label" for="ver_instituicoes">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_instituicoes" id="edit_instituicoes" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_instituicoes">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="font-weight-normal"> Usuários </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_usuarios" class="custom-control-input" tabindex="3" id="ver_usuarios">
                                            <label class="custom-control-label" for="ver_usuarios">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_usuarios" id="edit_usuarios" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_usuarios">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 col-2">
                                        <label class="font-weight-normal"> Grupos de usuários </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_grupos_usuarios" class="custom-control-input" tabindex="3" id="ver_grupos_usuarios">
                                            <label class="custom-control-label" for="ver_grupos_usuarios">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_grupos_usuarios" id="edit_grupos_usuarios" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_grupos_usuarios">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 col-2">
                                        <label class="font-weight-normal"> Página Inicial </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_pagina"  id="ver_pagina" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="ver_configuracoes">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_pagina" id="edit_pagina" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_configuracoes">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2 col-2">
                                        <label class="font-weight-normal"> Plataforma </label>
                                        <div class="text-left">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ver_plataforma"  id="ver_plataforma" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="ver_plataforma">Visualizar</label>
                                          </div>
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="edit_plataforma" id="edit_plataforma" class="custom-control-input" tabindex="3">
                                            <label class="custom-control-label" for="edit_plataforma">Gerenciar</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12 mb-5 text-right">
                            <a href="{{ route('exibir.grupos') }}" class="btn btn-secondary col-2 mx-1">Cancelar</a>
                            <button class="btn waves-effect waves-light col-2 mx-1">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('support')
<script type="text/javascript">
    $(document).ready(function (){
        $('#acesso_total').on('click', function(){
            if($(this).is(':checked')){
                $('#card-2 .card-body input[type=checkbox]').attr('checked', 'checked');
            }else{
                $('#card-2 .card-body input[type=checkbox]').removeAttr('checked');
            }
        });

        $('#card-2 .card-body input[type=checkbox]').on('click', function(){
            $(this).each(function(index) {
                if($(this).is(':checked')){
                    $('#acesso_total').attr('checked', 'checked');
                }else{
                    $('#acesso_total').removeAttr('checked');
                }
            });
        });
    });
</script>
@endsection
