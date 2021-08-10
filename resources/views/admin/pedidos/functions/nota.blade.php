<div class="modal fade" id="modal-nota" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header d-block col-12">
                    <div class="col-12 d-flex py-2">
                        <h4 class="titulo_modal titulo_modal">
                            @if(!($pedido->id_nota))
                                Adicionar nota fiscal
                            @else
                                Editar nota fiscal
                            @endif
                        </h4>
                        <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </div>
                </div>
                
                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formNotas" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group col-6">
                                <label>Número da nota <i class="text-danger">*</i></label>
                                <input type="text" name="numero_nota" class="form-control" placeholder="55466813233465877" value="{{(isset($pedido->RelationNotas->numero_nota) ? $pedido->RelationNotas->numero_nota : '')}}" onkeyup="this.value = this.value.toUpperCase();" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Data de emissão <i class="text-danger">*</i></label>
                                <input type="date" name="data_emissao" class="form-control" placeholder="00/00/0000" value="{{(isset($pedido->RelationNotas->data_emissao) ? $pedido->RelationNotas->data_emissao : '')}}" required>
                            </div>
                        </div>
                        <div class="form-group col-8">
                            <label>Número de série</label>
                            <input type="text" name="numero_serie" class="form-control" value="{{(isset($pedido->RelationNotas->numero_serie) ? $pedido->RelationNotas->numero_serie : '')}}">
                        </div>
                        <div class="form-group col-6">
                            <label>Chave</label>
                            <input type="text" name="chave" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{(isset($pedido->RelationNotas->chave) ? $pedido->RelationNotas->chave : '')}}">
                        </div>
                        <div class="form-group col-8">
                            <label>URL da nota</label>
                            <input type="text" name="url_nota" class="form-control" value="{{(isset($pedido->RelationNotas->url_nota) ? $pedido->RelationNotas->url_nota : '')}}">
                        </div>
                        <div class="form-group col-12">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck1" name="alterar_status" checked>
                              <label class="custom-control-label" for="customCheck1">Alterar status para <b>Faturado</b> </label>
                            </div>
                        </div>

                        <hr>
                        <div class="modal-footer py-1">
                            <div class="col-12 text-right">
                                <button class="btn btn-outline-danger col-3 mx-1 shadow-none" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                <button class="btn btn-success col-3 mx-1 shadow-none">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>