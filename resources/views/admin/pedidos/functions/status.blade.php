<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header d-block col-12">
                    <div class="col-12 d-flex py-2">
                        <h4 class="titulo_modal titulo_modal">Alterar status</h4>
                        <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </div>
                </div>
                
                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formStatus" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-7">
                            <label>Status <i class="text-danger">*</i></label>
                            <select name="id_status" required>
                                <option disabled="disabled">Selecione</option>
                                @foreach($status as $status)
                                    <option value="{{$status->id}}" {{($pedido->RelationStatus->last()->id_status == $status->id ? ' selected' : '')}}>{{$status->nome}}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group col-12">
                            <label>Observações</label>
                            <textarea name="observacoes">Criado por {{Auth::user()->nome}}</textarea>
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