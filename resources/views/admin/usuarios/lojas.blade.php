<div class="modal fade" id="usuarios-lojas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="card my-0">
                <div class="card-header row">
                    <div class="col-12">
                        <button type="button" class="ml-auto mb-auto close" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close"></i>
                        </button>
                        <h3 class="modal-title">Nova loja </h3>
                        <label class="mb-1"> Cadastre uma nova loja para relacionar ao seu produto.</label>
                    </div>
                    <div class="d-block col-12 mt-1">          
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="informacoes-tab" data-toggle="tab" href="#informacoes" role="tab" aria-controls="informacoes" aria-selected="true">Informações básicas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="localizacao-tab" data-toggle="tab" href="#localizacao" role="tab" aria-controls="localizacao" aria-selected="false">Localização <i class="text-danger">*</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="imagens-tab" data-toggle="tab" href="#imagens" role="tab" aria-controls="imagens" aria-selected="false">Imagens <i class="text-danger">*</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contatos-tab" data-toggle="tab" href="#contatos" role="tab" aria-controls="contatos" aria-selected="false">Contatos <i class="text-danger">*</i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div id="err"></div>
                    <div class="carregamento"></div>
                    <form id="formLojas" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="acao" value="modal">
                        <input type="hidden" name="status" value="on">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab">
                                <div class="form-group mb-2 col-8">
                                    <label class="mb-0">Nome da loja <small>(Visível ao público)</small><i class="text-danger">*</i></label>
                                    <input type="text" name="nome" class="form-control" placeholder="CompreCá" required>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mb-2 col-8">
                                        <label class="mb-0">Razão Social<i class="text-danger">*</i></label>
                                        <input type="text" name="razao_social" class="form-control" placeholder="CompreCá MarketPlace - ME" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>
                                    <div class="form-group mb-2 col-4">
                                        <label class="mb-0">Documento <small>(CNPJ/CPF)</small> <i class="text-danger">*</i></label>
                                        <input type="text" name="documento" id="documento" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-6">
                                    <label class="mb-0">Selecione a instituição responsável <i class="text-danger">*</i></label>
                                    <div class="col-12 p-0">
                                        <select id="listaInstituicoes" name="id_instituicao">
                                            <option disabled="disabled">Selecione</option>
                                            @foreach($instituicoes as $instituicao)
                                            <option value="{{$instituicao->id}}">{{$instituicao->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-12 descricao">
                                    <label class="mb-0">Descrição da loja</label>
                                    <textarea name="descricao"></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="localizacao" role="tabpanel" aria-labelledby="localizacao-tab">
                                <div class="d-flex">
                                    <div class="form-group col-3">
                                        <label>CEP <i class="text-danger">*</i></label>
                                        <input type="text" name="cep" class="cep form-control" placeholder="39270-000" required>
                                        <small class="error"></small>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Endereço <i class="text-danger">*</i></label>
                                        <input type="text" name="endereco" class="form-control" placeholder="Rua da Antonio Nascimento" onkeyup="this.value = this.value.toUpperCase();" required>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group col-2">
                                        <label>Numero <i class="text-danger">*</i></label>
                                        <input type="number" name="numero" class="form-control" placeholder="268" required>
                                    </div>
                                    <div class="form-group col-10">
                                        <label>Complemento</label>
                                        <input type="text" name="complemento" placeholder="Ex.: Apt., Loja 1, Casa" class="form-control" onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group col-5">
                                        <label>Bairro <i class="text-danger">*</i></label>
                                        <input type="text" name="bairro" class="bairro form-control" onkeyup="this.value = this.value.toUpperCase();" required>
                                        <input type="hidden" name="bairro1" class="bairro1">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Cidade <i class="text-danger">*</i></label>
                                        <input type="text" name="cidade" class="cidade form-control" onkeyup="this.value = this.value.toUpperCase();" required>
                                        <input type="hidden" name="cidade1" class="cidade1">
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Estado <i class="text-danger">*</i></label>
                                    <input type="text" name="estado" class="estado form-control" onkeyup="this.value = this.value.toUpperCase();" required>
                                    <input type="hidden" name="estado1" class="estado1">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="imagens" role="tabpanel" aria-labelledby="imagens-tab">
                                <div class="d-flex">
                                    <div class="col-5">
                                        <div class="col-12 form-group mb-3">
                                            <h6 class="col-12 row mb-0">Selecione sua logomarca <i class="text-danger">*</i></h6>
                                            <small>Formatos de imagem aceitos: .png, .jpg ou .svg</small>
                                            <div class="row mt-1">
                                                <div class="col-6">
                                                    <div class="border p-3 rounded text-center">
                                                        <img class="w-100" id="PreviewImage" src="{{ asset('public/admin/img/system/product.png').'?'.rand() }}" style="height: 100px;" >
                                                        <input type="file" class="px-0 col-12 position-absolute mx-auto h-100 pointer" style="opacity: 0; top: 0%; left: 0%" accept="image/*" name="id_logomarca" id="id_logomarca" onchange="image(this);" title="Selecione sua imagem">
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-12 form-group mb-3">
                                            <h6 class="col-12 row mb-0">Selecione uma imagem de fundo <i class="text-danger">*</i></h6>
                                            <small>Formatos de imagem aceitos: .png, .jpg ou .svg</small>
                                            <div class="row mt-1">
                                                <div class="col-6">
                                                    <div class="border p-3 rounded text-center">
                                                        <img class="w-100" id="PreviewImage" src="{{ asset('public/admin/img/system/product.png').'?'.rand() }}" style="height: 100px;" >
                                                        <input type="file" class="px-0 col-12 position-absolute mx-auto h-100 pointer" style="opacity: 0; top: 0%; left: 0%" accept="image/*" name="id_imagem" id="id_imagem1" onchange="image(this);" title="Selecione sua imagem">
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-6 m-auto text-center">
                                        <div class="d-flex px-4 mb-3 justify-content-center" id="PreviewImageLoja">
                                            <img class="w-100 rounded" id="PreviewFundo" src="{{ asset('public/admin/img/system/product.png').'?'.rand() }}" class="rounded">
                                        </div>
                                        <small><b>Exemplo de como será visualizado pelos clientes</b></small>
                                    </div>  
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contatos" role="tabpanel" aria-labelledby="contatos-tab">
                                <div class="form-group mb-2 col-5">
                                    <label class="mb-0">Telefone de contato <i class="text-danger">*</i></label>
                                    <input type="text" name="telefone" class="telefone form-control" placeholder="(38) 3245-6653" required>
                                </div>
                                <div class="form-group mb-2 col-6">
                                    <label class="mb-0">E-mail <i class="text-danger">*</i></label>
                                    <input type="email" name="email" class="form-control" placeholder="suporte@compreca.com.br" required>
                                </div>
                                <div class="form-group mb-2 col-8">
                                    <label class="mb-0">URL do Instagram</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.instagram.com/</span>
                                        <input type="text" name="url_instagram" class="form-control mx-2" placeholder="compreca">
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-8">
                                    <label class="mb-0">URL do Facebook</label>
                                    <div class="d-flex align-items-center">
                                        <span>https://www.facebook.com/</span>
                                        <input type="text" name="url_facebook" class="form-control mx-2" placeholder="compreca">
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-8">
                                    <label class="mb-0">URL do WhatsApp</label>
                                    <div class="d-flex align-items-center">
                                        <span>http://api.whatsapp.com/send?1=pt_BR&phone=+55</span>
                                        <input type="tel" name="url_whatsapp" class="form-control mx-2 col-4" placeholder="38991680335">
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
