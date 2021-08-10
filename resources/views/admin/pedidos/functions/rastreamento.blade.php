<div class="modal fade" id="modal-rastreamento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header d-block col-12">
                    <div class="col-12 d-flex py-2">
                        <h4 class="titulo_modal titulo_modal">Rastreamento</h4>
                        <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formRastreamento" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-4">
                            <label class="mb-0">Código de rastreamento <span class="text-danger">*</span></label>
                            <input type="text" name="cod_rastreamento" class="form-control" value="{{(isset($pedido->RelationRastreios->cod_rastreamento) ? $pedido->RelationRastreios->cod_rastreamento : '')}}" onkeyup="this.value = this.value.toUpperCase();" required> 
                            <small>Exemplo: SR004565BR</small>
                        </div>
                        <div class="form-group col-12">
                            <label class="mb-0">Link de rastreamento </label>
                            <input type="text" name="link_rastreamento" class="form-control" value="{{(isset($pedido->RelationRastreios->link_rastreamento) ? $pedido->RelationRastreios->link_rastreamento : '')}}">
                            <small>Exemplo: http://www.linkcorreios.com.br/SR004565BR</small>
                        </div>
                        <div class="form-group col-12 descricao">
                            <label class="mb-0">Observações</label>
                            <textarea name="observacoes">Criado por {{Auth::user()->nome}}</textarea>
                        </div>
                        <div class="form-group col-12">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck2" name="alterar_status" checked>
                              <label class="custom-control-label" for="customCheck2">Alterar status para <b>Em transporte</b> </label>
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