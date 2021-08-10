<?php

/*
|--------------------------------------------------------------------------
| Área Administrativa
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'painel'], function (){
    // Funcionalidades 
    Route::group(['prefix' => ''], function(){
        Route::get('', 'UsuariosCtrl@Login')->name('login');
        Route::post('redirect', 'UsuariosCtrl@Redirecionar')->name('redirect');
        Route::post('forwading', 'UsuariosCtrl@Forwarding')->name('encaminhar.password');
        Route::get('newpassword/{token}', 'UsuariosCtrl@NewPassword')->name('new.password');
        Route::post('alterando', 'UsuariosCtrl@Alterar')->name('alterando.password');

        // Fuções internas
        Route::get('home', 'UsuariosCtrl@Home')->name('home')->middleware('admin');
        Route::get('dashboard', 'UsuariosCtrl@dashboard')->name('dashboard')->middleware('admin');
        Route::get('logout', 'UsuariosCtrl@Sair')->name('logout')->middleware('admin');
        Route::get('perfil', 'UsuariosCtrl@Perfil')->name('perfil')->middleware('admin');
        Route::post('salvarPerfil', 'UsuariosCtrl@SalvarPerfil')->name('salvar.perfil')->middleware('admin');   
        Route::get('activities', 'UsuariosCtrl@Atividades')->name('atividades')->middleware('admin');
        Route::get('permission', 'UsuariosCtrl@Permissoes')->name('permission')->middleware('admin');
    });

    // Pedidos
    Route::group(['prefix' => 'pedidos'], function (){
        Route::get('/', 'PedidosCtrl@Exibir')->name('exibir.pedidos');
        Route::get('lista', 'PedidosCtrl@Lista')->name('listar.pedidos');
        Route::get('detalhes/{id}', 'PedidosCtrl@Detalhes')->name('detalhes.pedidos');
        // Atualizar informações
        Route::post('status/{id}', 'PedidosCtrl@AtualizarStatus')->name('atualizar.status');
        Route::post('notas/{id}', 'PedidosCtrl@AtualizarNota')->name('atualizar.nota');
        Route::post('endereco/{id}', 'PedidosCtrl@AtualizarEndereco')->name('atualizar.endereco');
        Route::post('rastreamento/{id}', 'PedidosCtrl@AtualizarRastreamento')->name('atualizar.rastreamento');
    });

    // Carrinhos abandonados
    Route::group(['prefix' => 'carrinhos'], function (){
        Route::get('/', 'CarrinhosCtrl@Exibir')->name('exibir.carrinhos');
        Route::get('lista', 'CarrinhosCtrl@Lista')->name('listar.carrinhos');
        Route::get('editar/{id}', 'CarrinhosCtrl@Editar')->name('editar.carrinhos');
        Route::post('editando/{id}', 'CarrinhosCtrl@SalvarEditar')->name('editando.carrinhos');
        Route::get('detalhes/{id}', 'CarrinhosCtrl@Detalhes')->name('detalhes.carrinhos');
    });

    // Produtos
    Route::group(['prefix' => 'produtos'], function (){
        Route::get('/', 'ProdutosCtrl@Exibir')->name('exibir.produtos');
        Route::get('lista', 'ProdutosCtrl@Lista')->name('listar.produtos');
        Route::get('adicionar', 'ProdutosCtrl@Adicionar')->name('adicionar.produtos');
        Route::post('salvar', 'ProdutosCtrl@SalvarAdicionar')->name('salvar.produtos');
        Route::get('editar/{id}', 'ProdutosCtrl@Editar')->name('editar.produtos');
        Route::post('editando/{id}', 'ProdutosCtrl@SalvarEditar')->name('editando.produtos');
        Route::get('status/{id}', 'ProdutosCtrl@Status')->name('status.produtos');
        Route::any('imagens', 'ProdutosCtrl@Imagens')->name('imagens.produtos');
        Route::any('removeImagem/{id}', 'ProdutosCtrl@RemoveImagens')->name('removeImagens.produtos');
    });

    // Categorias
    Route::group(['prefix' => 'categorias'], function (){
        Route::get('/', 'CategoriasCtrl@Exibir')->name('exibir.categorias');
        Route::get('lista', 'CategoriasCtrl@Lista')->name('listar.categorias');
        Route::get('adicionar', 'CategoriasCtrl@Adicionar')->name('adicionar.categorias');
        Route::post('salvar', 'CategoriasCtrl@SalvarAdicionar')->name('salvar.categorias');
        Route::get('editar/{id}', 'CategoriasCtrl@Editar')->name('editar.categorias');
        Route::post('editando/{id}', 'CategoriasCtrl@SalvarEditar')->name('editando.categorias');
        Route::get('detalhes/{id}', 'CategoriasCtrl@Detalhes')->name('detalhes.categorias');
        Route::get('status/{id}', 'CategoriasCtrl@Status')->name('status.categorias');
        Route::get('home/{id}', 'CategoriasCtrl@Home')->name('home.categorias');
    });

    // Marcas
    Route::group(['prefix' => 'marcas'], function (){
        Route::get('/', 'MarcasCtrl@Exibir')->name('exibir.marcas');
        Route::get('lista', 'MarcasCtrl@Lista')->name('listar.marcas');
        Route::get('adicionar', 'MarcasCtrl@Adicionar')->name('adicionar.marcas');
        Route::post('salvar', 'MarcasCtrl@SalvarAdicionar')->name('salvar.marcas');
        Route::get('editar/{id}', 'MarcasCtrl@Editar')->name('editar.marcas');
        Route::post('editando/{id}', 'MarcasCtrl@SalvarEditar')->name('editando.marcas');
        Route::get('status/{id}', 'MarcasCtrl@Status')->name('status.marcas');
        Route::get('home/{id}', 'MarcasCtrl@Home')->name('home.marcas');
    });

    // Variações 
    Route::group(['prefix' => 'variacoes'], function (){
        Route::get('/', 'VariacoesCtrl@Exibir')->name('exibir.variacoes');
        Route::get('lista', 'VariacoesCtrl@Lista')->name('listar.variacoes');
        Route::get('adicionar', 'VariacoesCtrl@Adicionar')->name('adicionar.variacoes');
        Route::post('salvar', 'VariacoesCtrl@SalvarAdicionar')->name('salvar.variacoes');
        Route::get('editar/{id}', 'VariacoesCtrl@Editar')->name('editar.variacoes');
        Route::post('editando/{id}', 'VariacoesCtrl@SalvarEditar')->name('editando.variacoes');
        Route::get('detalhes/{id}', 'VariacoesCtrl@Detalhes')->name('detalhes.variacoes');
        Route::get('status/{id}', 'VariacoesCtrl@Status')->name('status.variacoes');
        Route::post('opcao', 'VariacoesCtrl@SalvarOpcao')->name('opcoes.variacoes');
    });

    // Clientes
    Route::group(['prefix' => 'clientes'], function (){
        Route::get('/', 'ClientesCtrl@Exibir')->name('exibir.clientes');
        Route::get('lista', 'ClientesCtrl@Lista')->name('listar.clientes');
        Route::get('adicionar', 'ClientesCtrl@Adicionar')->name('adicionar.clientes');
        Route::post('salvar', 'ClientesCtrl@SalvarAdicionar')->name('salvar.clientes');
        Route::get('editar/{id}', 'ClientesCtrl@Editar')->name('editar.clientes');
        Route::post('editando/{id}', 'ClientesCtrl@SalvarEditar')->name('editando.clientes');
        Route::get('status/{id}', 'ClientesCtrl@Status')->name('status.clientes');
        Route::get('resetar/{id}', 'ClientesCtrl@Resetar')->name('resetar.clientes');
    });

    // Leads
    Route::group(['prefix' => 'leads'], function (){
        Route::get('/', 'LeadsCtrl@Exibir')->name('exibir.leads');
        Route::get('lista', 'LeadsCtrl@Lista')->name('listar.leads');
        Route::get('adicionar', 'LeadsCtrl@Adicionar')->name('adicionar.leads');
        Route::post('salvar', 'LeadsCtrl@SalvarAdicionar')->name('salvar.leads');
        Route::get('editar/{id}', 'LeadsCtrl@Editar')->name('editar.leads');
        Route::post('editando/{id}', 'LeadsCtrl@SalvarEditar')->name('editando.leads');
    });

    // Configurações
    Route::group(['prefix' => 'configuracoes'], function (){
        Route::get('', 'ConfiguracoesCtrl@Exibir')->name('configuracoes');
        // Geral
        Route::group(['prefix' => 'geral'], function (){
            Route::get('', 'ConfiguracoesCtrl@Geral')->name('configuracoes.geral');
            Route::post('editando', 'ConfiguracoesCtrl@SalvarGeral')->name('configuracoes.editando.geral');
        });
        // Usuarios
        Route::group(['prefix' => 'usuarios'], function (){
            Route::get('', 'ConfiguracoesCtrl@Usuarios')->name('configuracoes.usuarios');
            Route::get('lista', 'ConfiguracoesCtrl@Lista')->name('configuracoes.listar.usuarios');
            Route::get('adicionar', 'ConfiguracoesCtrl@Adicionar')->name('configuracoes.adicionar.usuarios');
            Route::post('salvar', 'ConfiguracoesCtrl@SalvarAdicionar')->name('configuracoes.salvar.usuarios');
            Route::get('editar/{id}', 'ConfiguracoesCtrl@Editar')->name('configuracoes.editar.usuarios');
            Route::post('editando/{id}', 'ConfiguracoesCtrl@SalvarEditar')->name('configuracoes.editando.usuarios');
            Route::get('status/{id}', 'ConfiguracoesCtrl@Status')->name('configuracoes.status.usuarios');
        });
        // Integrações
        Route::get('integracoes', 'ConfiguracoesCtrl@Integracoes')->name('configuracoes.integracoes');
    });

    // Lojas
    Route::group(['prefix' => 'lojas'], function (){
        Route::get('/', 'LojasCtrl@Exibir')->name('exibir.lojas');
        Route::get('lista', 'LojasCtrl@Lista')->name('listar.lojas');
        Route::get('adicionar', 'LojasCtrl@Adicionar')->name('adicionar.lojas');
        Route::post('salvar', 'LojasCtrl@SalvarAdicionar')->name('salvar.lojas');
        Route::get('editar/{id}', 'LojasCtrl@Editar')->name('editar.lojas');
        Route::post('editando/{id}', 'LojasCtrl@SalvarEditar')->name('editando.lojas');
        Route::get('status/{id}', 'LojasCtrl@Status')->name('status.lojas');
        Route::get('home/{id}', 'LojasCtrl@Home')->name('home.lojas');
    });

    // Instituições
    Route::group(['prefix' => 'instituicoes'], function (){
        Route::get('/', 'InstituicoesCtrl@Exibir')->name('exibir.instituicoes');
        Route::get('lista', 'InstituicoesCtrl@Lista')->name('listar.instituicoes');
        Route::get('adicionar', 'InstituicoesCtrl@Adicionar')->name('adicionar.instituicoes');
        Route::post('salvar', 'InstituicoesCtrl@SalvarAdicionar')->name('salvar.instituicoes');
        Route::get('editar/{id}', 'InstituicoesCtrl@Editar')->name('editar.instituicoes');
        Route::post('editando/{id}', 'InstituicoesCtrl@SalvarEditar')->name('editando.instituicoes');
        Route::get('status/{id}', 'InstituicoesCtrl@Status')->name('status.instituicoes');
        Route::get('home/{id}', 'InstituicoesCtrl@Home')->name('home.instituicoes');
    });

    // Usuários
    Route::group(['prefix' => 'usuarios', 'middleware' => 'admin'], function (){
        Route::get('/', 'UsuariosCtrl@Exibir')->name('exibir.usuarios');
        Route::get('lista', 'UsuariosCtrl@Lista')->name('listar.usuarios');
        Route::get('adicionar', 'UsuariosCtrl@Adicionar')->name('adicionar.usuarios');
        Route::post('salvar', 'UsuariosCtrl@SalvarAdicionar')->name('salvar.usuarios');
        Route::get('editar/{id}', 'UsuariosCtrl@Editar')->name('editar.usuarios');
        Route::post('editando/{id}', 'UsuariosCtrl@SalvarEditar')->name('editando.usuarios');
        Route::get('status/{id}', 'UsuariosCtrl@Status')->name('status.usuarios');
        Route::get('resetar/{id}', 'UsuariosCtrl@Resetar')->name('resetar.usuarios');
    });

    // Grupos de Usuários
    Route::group(['prefix' => 'grupos'], function (){
        Route::get('/', 'GruposUsuariosCtrl@Exibir')->name('exibir.grupos');
        Route::get('lista', 'GruposUsuariosCtrl@Lista')->name('listar.grupos');
        Route::get('adicionar', 'GruposUsuariosCtrl@Adicionar')->name('adicionar.grupos');
        Route::post('salvar', 'GruposUsuariosCtrl@SalvarAdicionar')->name('salvar.grupos');
        Route::get('editar/{id}', 'GruposUsuariosCtrl@Editar')->name('editar.grupos');
        Route::post('editando/{id}', 'GruposUsuariosCtrl@SalvarEditar')->name('editando.grupos');
        Route::get('status/{id}', 'GruposUsuariosCtrl@Status')->name('status.grupos');
    });

    // Plataforma
    Route::group(['prefix' => 'plataforma'], function (){
        // Geral
        Route::group(['prefix' => 'geral'], function (){
            Route::get('/', 'PlataformaCtrl@Geral')->name('plataforma.geral');
            Route::post('salvar/{id}', 'PlataformaCtrl@SalvarGeral')->name('plataforma.salvar.geral');
        });
    });

    // Marketplace
    Route::group(['prefix' => 'marketplace'], function (){
        // Navbar
        Route::group(['prefix' => 'navbar'], function (){
            Route::get('', 'MarketplaceCtrl@ExibirNavbar')->name('exibir.navbar.marketplace');
            Route::post('salvar', 'MarketplaceCtrl@SalvarNavbar')->name('salvar.navbar.marketplace');
        });
        // Menu
        Route::group(['prefix' => 'menu'], function (){
            Route::get('', 'MarketplaceCtrl@ExibirMenu')->name('exibir.menu.marketplace');
            Route::post('adicionar', 'MarketplaceCtrl@AdicionarMenu')->name('adicionar.menu.marketplace');
            Route::post('editar/{id}', 'MarketplaceCtrl@EditarMenu')->name('editar.menu.marketplace');
            Route::get('delete/{id}', 'MarketplaceCtrl@RemoverMenu')->name('remover.menu.marketplace');
            Route::get('detalhes/{id}', 'MarketplaceCtrl@DetalhesMenu')->name('detalhes.menu.marketplace');
        });
        // Slider
        Route::group(['prefix' => 'slider'], function (){
            Route::get('', 'MarketplaceCtrl@ExibirSlider')->name('exibir.slider.marketplace');
            Route::post('salvar', 'MarketplaceCtrl@SalvarSlider')->name('salvar.slider.marketplace');
            Route::get('remover/{id}', 'MarketplaceCtrl@RemoverSlider')->name('remover.slider.marketplace');
        });
        // Sections
        Route::group(['prefix' => 'sections'], function (){
            Route::get('', 'MarketplaceCtrl@ExibirSections')->name('exibir.sections.marketplace');
            Route::post('salvarSections', 'MarketplaceCtrl@SalvarSections')->name('salvar.sections.marketplace');
            Route::get('opcoes/{tipo}/{id_section}', 'MarketplaceCtrl@ListarOpcoes')->name('opcoes.sections.marketplace');
            Route::get('remover/{id}', 'MarketplaceCtrl@RemoverSections')->name('remover.sections.marketplace');
        });
        // Footer
        Route::group(['prefix' => 'footer'], function (){
            Route::get('', 'MarketplaceCtrl@ExibirFooter')->name('exibir.footer.marketplace');
            Route::post('salvarFooter', 'MarketplaceCtrl@SalvarFooter')->name('salvar.footer.marketplace');
        });
    });
});


/*
|--------------------------------------------------------------------------
| Área voltada para os clientes do marketplace
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => ''], function (){

    // Área interna (Clientes)
    Route::group(['prefix' => 'me'], function (){
        // Pedidos
        Route::group(['prefix' => 'pedidos'], function (){
            Route::get('', 'PaginaInicialCtrl@Pedidos')->name('pedidos.mkt');
        });
        // Perfil
        Route::group(['prefix' => 'perfil'], function (){
            Route::get('', 'PaginaInicialCtrl@Perfil')->name('perfil.mkt');
            Route::post('processing/{id}', 'PaginaInicialCtrl@SalvarPerfil')->name('salvarPerfil.mkt');
        });
        // Endereços
        Route::group(['prefix' => 'enderecos'], function (){
            Route::get('', 'PaginaInicialCtrl@Enderecos')->name('enderecos.mkt');
            Route::post('adicionar', 'PaginaInicialCtrl@AdicionarEnderecos')->name('adicionarEnderecos.mkt');
            Route::post('editar', 'PaginaInicialCtrl@EditarEnderecos')->name('editarEnderecos.mkt');
            Route::get('remover/{id}', 'PaginaInicialCtrl@RemoverEnderecos')->name('removerEnderecos.mkt');
            Route::get('alterar/{id}', 'PaginaInicialCtrl@AlterarEnderecos')->name('alterarEnderecos.mkt');
            Route::get('detalhes/{id}', 'PaginaInicialCtrl@DetalhesEnderecos')->name('detalhesEnderecos.mkt');
        });
        // Favoritos
        Route::group(['prefix' => 'favoritos'], function (){
            Route::get('', 'PaginaInicialCtrl@Favoritos')->name('favoritos.mkt');
            Route::post('adicionar', 'PaginaInicialCtrl@AdicionarFavoritos')->name('adicionarFavoritos.mkt');
            Route::get('remover/{id}', 'PaginaInicialCtrl@RemoverFavoritos')->name('removerFavoritos.mkt');
        });
        // Avaliações
        Route::group(['prefix' => 'avaliacoes'], function (){
            Route::get('', 'PaginaInicialCtrl@Avaliacoes')->name('avaliacoes.mkt');
        });
        // Dúvidas
        Route::group(['prefix' => 'duvidas'], function (){
            Route::get('', 'PaginaInicialCtrl@Duvidas')->name('duvidas.mkt');
        });
    });

    // Área externa (Clientes)
    Route::group(['prefix' => ''], function (){
        // Página inicial
        Route::group(['prefix' => ''], function (){
            Route::get('', 'PaginaInicialCtrl@Home')->name('home.mkt');
        });
        // Login e Logout
        Route::group(['prefix' => 'login'], function (){
            Route::get('', 'PaginaInicialCtrl@Login')->name('login.mkt');
            Route::post('processing', 'PaginaInicialCtrl@processLogin')->name('processLogin.mkt');
            Route::get('logout', 'PaginaInicialCtrl@Logout')->name('logout.mkt');
        });
        // Cadastro
        Route::group(['prefix' => 'cadastro'], function (){
            Route::get('', 'PaginaInicialCtrl@Cadastro')->name('cadastro.mkt');
            Route::post('processing', 'PaginaInicialCtrl@SalvarCadastro')->name('processCadastro.mkt');
            Route::get('vEmail/{email}', 'PaginaInicialCtrl@ValidaEmail')->name('validaEmail.mkt');
            Route::get('vDoc/{documento}', 'PaginaInicialCtrl@ValidaDocumento')->name('validaDocumento.mkt');
            Route::get('active/{token}', 'PaginaInicialCtrl@AtivarCadastro')->name('ativarCadastro.mkt');
        });
        // Search
        Route::group(['prefix' => 'search'], function (){
            Route::any('', 'PaginaInicialCtrl@Search')->name('search.mkt');
        });
        // Carrinho de compras
        Route::group(['prefix' => 'carrinho'], function (){
            Route::any('', 'PaginaInicialCtrl@Carrinho')->name('carrinho.mkt');
        });
        // Produto
        Route::group(['prefix' => 'produto'], function (){
            Route::any('{cod_sku}', 'PaginaInicialCtrl@ProdutosDetalhes')->name('detalhes.produto.mkt');
        });
        // Lojas
        Route::group(['prefix' => 'lojas'], function (){
            Route::any('todas', 'PaginaInicialCtrl@Lojas')->name('listar.lojas.mkt');
            Route::any('{id}', 'PaginaInicialCtrl@LojasDetalhes')->name('detalhes.lojas.mkt');
        });
        // Instituições
        Route::group(['prefix' => 'instituicoes'], function (){
            Route::any('{id}', 'PaginaInicialCtrl@InstituicoesDetalhes')->name('detalhes.instituicoes.mkt');
        });
        // Marcas
        Route::group(['prefix' => 'marcas'], function (){
            Route::any('{id}', 'PaginaInicialCtrl@MarcasDetalhes')->name('detalhes.marcas.mkt');
        });
    });

});
