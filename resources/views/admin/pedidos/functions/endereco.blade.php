<div class="modal fade" id="modal-endereco" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header d-block col-12">
                    <div class="col-12 d-flex py-2">
                        <h4 class="titulo_modal titulo_modal">Editar informações</h4>
                        <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </div>
                </div>
                
                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formEndereco" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-3">
                            <label class="mb-0">CEP <i class="text-danger">*</i></label>
                            <input type="text" name="cep" class="cep form-control" placeholder="39270-000" value="{{$pedido->RelationEnderecos->cep}}" required>
                            <small class="error"></small>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-8">
                                <label class="mb-0">Endereço <i class="text-danger">*</i></label>
                                <input type="text" name="endereco" class="form-control" placeholder="Rua da Antonio Nascimento" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->endereco}}" required>
                            </div>
                            <div class="form-group col-4">
                                <label class="mb-0">Bairro <i class="text-danger">*</i></label>
                                <input type="text" name="bairro" class="bairro form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->bairro}}" required>
                                <input type="hidden" name="bairro1" class="bairro1" value="{{$pedido->RelationEnderecos->bairro}}">
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-2">
                                <label class="mb-0">Numero <i class="text-danger">*</i></label>
                                <input type="number" name="numero" class="form-control" placeholder="268" value="{{$pedido->RelationEnderecos->numero}}" required>
                            </div>
                            <div class="form-group col-10">
                                <label class="mb-0">Complemento</label>
                                <input type="text" name="complemento" placeholder="Ex.: Apt., Loja 1, Casa" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->complemento}}">
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-5">
                                <label class="mb-0">Cidade <i class="text-danger">*</i></label>
                                <input type="text" name="cidade" class="cidade form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->cidade}}" disabled>
                                <input type="hidden" name="cidade1" class="cidade1" value="{{$pedido->RelationEnderecos->cidade}}">
                            </div>
                            <div class="form-group col-4">
                                <label class="mb-0">Estado <i class="text-danger">*</i></label>
                                <input type="text" name="estado" class="estado form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->estado}}" disabled>
                                <input type="hidden" name="estado1" class="estado1" value="{{$pedido->RelationEnderecos->estado}}">
                            </div>
                        </div>
                        <div class="form-group col-8">
                                <label class="mb-0">Destinatário <i class="text-danger">*</i></label>
                                <input type="text" name="destinatario" class="destinatario form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$pedido->RelationEnderecos->destinatario}}" required>
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