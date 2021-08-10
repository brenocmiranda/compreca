<div class="modal fade" id="usuarios-grupos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="card my-0">
        <div class="card-header row">
          <div class="col-12">
            <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
            </button>
            <h3 class="modal-title">Novo grupo </h3>
            <label class="mb-1"> Cadastre um novo grupo para relacionar ao seu produto.</label>
          </div>
          <div class="d-block col-12 mt-1">          
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="informacoesGrupo-tab" data-toggle="tab" href="#informacoesGrupo" role="tab" aria-controls="informacoesGrupo" aria-selected="true">Informações básicas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="permissoes-tab" data-toggle="tab" href="#permissoes" role="tab" aria-controls="permissoes" aria-selected="false">Permissões <i class="text-danger">*</i></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="card-body">
          <div id="err"></div>
          <div class="carregamento"></div>
          <form id="formGrupos" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="acao" value="modal">
            <input type="hidden" name="status" value="on">

            <div class="tab-content" id="myTabContent">

              <div class="tab-pane fade show active" id="informacoesGrupo" role="tabpanel" aria-labelledby="informacoesGrupo-tab">
                <div class="form-group col-10">
                  <label>Nome do grupo <i class="text-danger">*</i></label>
                  <input type="text" name="nome" class="form-control" placeholder="Categoria 1" required>
                </div>
              </div>

              <div class="tab-pane fade" id="permissoes" role="tabpanel" aria-labelledby="permissoes-tab">
                <div class="row col m-0">
                  <div class="col-12 d-flex">
                    <div class="form-group mb-3">
                      <div class="mx-3 my-auto custom-control custom-checkbox">
                        <input type="checkbox" name="acesso_total" class="custom-control-input" tabindex="3" id="acesso_total">
                        <label class="custom-control-label" for="acesso_total">Acesso total</label>
                      </div>
                    </div>
                  </div>

                  <h6> Operacional </h6>
                  <hr class="mt-0 col-12 p-0">
                  <div class="col-12 row">
                    <div class="form-group mb-2 col-2">
                      <label class="font-weight-normal"> Dashboard </label>
                      <div class="text-left">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" name="ver_dashboard" class="custom-control-input" tabindex="3" id="ver_dashboard">
                          <label class="custom-control-label" for="ver_pedidos">Visualizar</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                  </div>
                  
                  <h6> Gerencial </h6>
                  <hr class="mt-0 col-12 p-0">
                  <div class="col-12 row">
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                    <div class="form-group mb-2 col-2">
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
                </div>
              </div>
            </div>

            <hr class="mt-0">

            <div class="modal-footer py-1">
              <div class="col-12 text-center">
                <button class="btn btn-secondary col-3 mx-1 shadow-none" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button class="btn waves-effect waves-light col-3 mx-1 shadow-none">Salvar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
