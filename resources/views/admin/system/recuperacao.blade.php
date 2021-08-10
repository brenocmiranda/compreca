<!-- Modal de recuperação de password -->
<div class="modal fade" id="modal-recuperar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="card mb-0">
        <div class="card-header py-0">
          <h5 class="my-auto">Recuperar senha</h5>
          <button type="button" class="ml-auto close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body" >
          <div id="err"></div>
          <div class="carregamento"></div>
          <form id="formRecuperar" enctype="multipart/form-data">
            @csrf
            <label class="my-2 mx-3">Para recuperar a sua senha,  serão enviadas por e-mail algumas etapas para serem seguidas. Preencha abaixo os dados solicitados para recuperação de senha.</label>
            
            <div class="form-group col-10 m-2">
              <label class="mb-0">E-mail:</label>
              <input type="email" class="form-control" name="email" placeholder="administrador@compreca.com.br">
            </div>
            <div class="col-12 m-4 ml-auto">
              <button class="btn col-3 mx-1 shadow-none d-flex align-items-center justify-content-center ml-auto">
                <span>Enviar</span> 
                <i class="mdi mdi-send-outline px-1"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>