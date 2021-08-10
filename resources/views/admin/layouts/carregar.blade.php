<!-- Carregamento de página -->
<div class="position-absolute container-fluid" id="modal-processamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" style="z-index:10000; background: #00000066;">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="mx-auto">
            <div class="modal-body">
                <div class="row mx-auto">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="position-absolute">
                            <img src="{{ asset('storage/app/system/icon.png').'?'.rand() }}" style="height: 70px;">
                        </div>
                        <div class="spinner-border text-light" role="status" style="width: 5.5rem; height: 5.5rem;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carregamento de página -->