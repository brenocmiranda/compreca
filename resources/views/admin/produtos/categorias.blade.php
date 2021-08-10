<div class="modal fade" id="produtos-categorias" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="card mb-0">
                <div class="card-header">
                    <div class=" mx-3">
                        <h3 class="modal-title">Nova categoria </h3>
                        <label class="mb-0"> Cadastre uma nova categoria para relacionar ao seu produto.</label>
                    </div>
                    <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formCategorias" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="acao" value="modal">
                        <input type="hidden" name="status" value="on">
                        <div class="row mb-0">
                            <div class="col-8">
                                <div class="form-group col-12">
                                    <label>Nome da categoria <i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="Categoria 1" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Descrição da categoria</label>
                                    <textarea class="summernote-simple" name="descricao"></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-0">
                                    <div class="text-center">
                                        <label class="col-12 row font-weight-bold text-dark">Selecione a imagem <i class="text-danger">*</i>
                                        </label>
                                        <div id="PreviewImage" class="image-preview w-100" style="height: 300px;">
                                          <label for="id_imagem_categoria" id="image-label" class="text-white rounded">Selecione</label>
                                          <input type="file" accept="image/*" name="id_imagem" id="id_imagem_categoria" onchange="image(this);">
                                        </div>  
                                        <small class="my-2">Aceitamos .png, .jpg ou .svg</small>
                                    </div>
                                </div>
                            </div>
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
