<div class="modal fade" id="produtos-variantes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header">
                    <div class=" mx-3">
                        <h3 class="modal-title">Nova variação </h3>
                        <label class="mb-0"> Cadastre uma nova variação para relacionar ao seu produto.</label>
                    </div>
                    <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formVariante" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="acao" value="modal">
                        <input type="hidden" name="status" value="on">
                        <div class="form-group col-8">
                            <label>Nome da variação <i class="text-danger">*</i></label>
                            <input type="text" name="nome" class="form-control" placeholder=" Ex.: Tamanho M" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="mb-0">Opções <i class="text-danger">*</i></label>
                            <div class="d-flex align-items-center">
                                <div class="col-4 p-0">
                                    <select class="id_opcao" name="id_opcao">
                                        <option disabled>Selecione uma opção</option>
                                        @if(isset($opcoes))
                                            @foreach($opcoes as $opcao)
                                            <option value="{{$opcao->id}}">{{$opcao->nome}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label>Valor <i class="text-danger">*</i></label>
                            <input type="text" name="valor" class="form-control" placeholder=" Ex.: PP, P, M, G, GG" required>
                        </div>

                        <hr>

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