<div class="modal fade" id="variacao-opcao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title mb-3">Nova opção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="err"></div>
            </div>
            
            <div class="carregamento"></div>

            <form method="POST" id="formOpcao" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group col-10">
                        <label>Nome <span class="text-danger">*</span></label>
                        <input type="text" name="nome" class="form-control">
                    </div>
                </div>

                <hr>

                <div class="text-center mx-auto pb-4">
                    <button type="button" class="btn btn-danger col-3 shadow-none" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn waves-effect waves-light col-3 shadow-none">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>

