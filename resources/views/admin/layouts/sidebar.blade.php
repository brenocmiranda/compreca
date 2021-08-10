<div class="main-sidebar">
  <aside id="sidebar-wrapper">

    <div class="sidebar-brand">
      <a href="{{ route('home') }}">
        <img src="<x-logomarca/>" alt="Logo CompreCá" style="max-height: 38px;">
      </a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('home') }}">
        <img src="<x-icone/>" alt="" style="max-width: 32px;">
      </a>
    </div>

    <div class="user-profile mb-4">
      <div class="mt-4">
        <div class="text-center image">
          <img src="{{ (isset(Auth::guard('admin')->user()->RelationImagens) ? asset('storage/app/'.Auth::guard('admin')->user()->RelationImagens->caminho.'?'.rand()) : asset('public/admin/img/user.png')) }}" alt="user-img" class="perfil rounded-circle" width="60">
        </div>
        <div class="text-center name mt-3">
          <div class="col-12">
            <h6 class="text-dark text-truncate font-weight-normal mb-1">
                {{ Auth::guard('admin')->user()->nome }}
            </h6>
          </div>
          <div class="col-12">
            <label class="text-dark font-weight-bold mb-0">
              {{(isset(Auth::guard('admin')->user()->RelationLojas) ? Auth::guard('admin')->user()->RelationLojas->nome : 'Não atribuído') }}
            </label>
          </div>
          <div class="col-12">
            <small class="badge text-dark font-weight-bold mb-0">
              {{(isset(Auth::guard('admin')->user()->RelationGrupo) ? Auth::guard('admin')->user()->RelationGrupo->nome : 'Não atribuído') }}
            </small>
          </div>
        </div>
      </div>
    </div>

    <ul class="sidebar-menu mb-4">
      <li class="menu-header">Gerencial</li>

      <li class="nav-item dropdown {{ (Request::segment(2) == 'home' ? 'active' : '')}}">
        <a href="{{ route('home') }}" class="nav-link">
          <i class="mdi mdi-home-outline mdi-24px"></i><span>Página Inicial</span>
        </a>
      </li>

      <li class="nav-item dropdown {{ (Request::segment(2) == 'dashboard' ? 'active' : '')}}">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="mdi mdi-chart-bar mdi-24px"></i><span>Visão Geral</span>
        </a>
      </li>

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_pedidos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_carrinhos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_carrinhos == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'pedidos' ? 'active' : '')}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-package-variant mdi-24px"></i> <span>Pedidos</span></a>
        <ul class="dropdown-menu">
          @if(Auth::guard('admin')->user()->RelationGrupo->ver_pedidos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pedidos == 1)
          <li><a class="nav-link" href="{{route('exibir.pedidos')}}"><b>Ver todos</b></a></li>
          @endif

          @if(Auth::guard('admin')->user()->RelationGrupo->ver_carrinhos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_carrinhos == 1)
          <li><a class="nav-link" href="{{route('exibir.carrinhos')}}">Carrinhos abandonados</a></li>
          @endif
        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_produtos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_categorias == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_marcas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_variacoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'produtos' ? 'active' : (Request::segment(2) == 'categorias' ? 'active' : (Request::segment(2) == 'marcas' ? 'active' : (Request::segment(2) == 'variacoes' ? 'active' : '')))) }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-dolly mdi-24px"></i> <span>Produtos</span></a>
        <ul class="dropdown-menu pb-2">
          @if(Auth::guard('admin')->user()->RelationGrupo->ver_produtos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1)
          <li><a class="nav-link" href="{{ route('exibir.produtos') }}"><b>Ver todos</b></a></li>
          @endif
          @if(Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1)
          <li><a class="nav-link" href="{{ route('adicionar.produtos') }}">+ Novo produto</a></li>
          @endif

          @if( (Auth::guard('admin')->user()->RelationGrupo->ver_produtos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_produtos == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_categorias == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_marcas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_variacoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1))
          <hr class="mx-4">
          @endif

          @if(Auth::guard('admin')->user()->RelationGrupo->ver_categorias == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_categorias == 1)
          <li><a class="nav-link" href="{{ route('exibir.categorias') }}">Departamentos</a></li>
          @endif
          @if(Auth::guard('admin')->user()->RelationGrupo->ver_marcas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_marcas == 1)
          <li><a class="nav-link" href="{{ route('exibir.marcas') }}">Marcas</a></li>
          @endif
          @if(Auth::guard('admin')->user()->RelationGrupo->ver_variacoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_variacoes == 1)
          <li><a class="nav-link" href="{{ route('exibir.variacoes') }}">Variações</a></li>
          @endif
        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_clientes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_leads == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'clientes' ? 'active' : '')}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-human-male-child mdi-24px"></i> <span>Clientes</span></a>
        <ul class="dropdown-menu">

          @if(Auth::guard('admin')->user()->RelationGrupo->ver_clientes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_clientes == 1)
          <li><a class="nav-link" href="{{ route('exibir.clientes') }}"><b>Ver todos</b></a></li>
          @endif
          @if(Auth::guard('admin')->user()->RelationGrupo->ver_leads == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_leads == 1)
          <li><a class="nav-link" href="{{ route('exibir.leads') }}">Leads</a></li>
          @endif

        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_marketing == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_marketing == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'relatorios' ? 'active' : '')}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-flag-outline mdi-24px"></i> <span>Marketing</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="#">Cupons</a></li>
          <li><a class="nav-link" href="#">Promoções</a></li>
          <li><a class="nav-link" href="#">Descontos</a></li>
          <li><a class="nav-link" href="#">Pixels</a></li>
        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_relatorios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_relatorios == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'relatorios' ? 'active' : '')}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-file-export-outline mdi-24px"></i> <span>Relatórios</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="#">Vendas por produto</a></li>
          <li><a class="nav-link" href="#">Boletos por produtos</a></li>
        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->RelationGrupo->ver_configuracoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1)
      <li class="nav-item dropdown {{ (Request::segment(2) == 'configuracoes' ? 'active' : '')}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-cog-outline mdi-24px"></i> <span>Configurações</span></a>
        <ul class="dropdown-menu pb-2">                  
          <li><a href="{{route('configuracoes.geral')}}" class="nav-link">Geral</a></li>
          <li><a href="{{route('configuracoes.usuarios')}}" class="nav-link">Usuários</a></li> 
          <li><a href="{{route('configuracoes.integracoes')}}" class="nav-link">Integrações</a></li> 
        </ul>
      </li>
      @endif

      @if(Auth::guard('admin')->user()->id_grupo == 1)
        @if((Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_instituicoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_grupos_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_plataforma == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_plataforma == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1))
        <li class="menu-header">Administrativo</li>
        @endif  

        @if(Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
        <li class="nav-item dropdown {{ (Request::segment(2) == 'lojas' ? 'active' : '')}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-home-outline mdi-24px"></i> <span>Lojas</span></a>
          <ul class="dropdown-menu pb-2">
            @if(Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
            <li><a class="nav-link" href="{{route('exibir.lojas')}}"><b>Ver todas</b></a></li>
            @endif
            @if(Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
            <li><a class="nav-link" href="{{route('adicionar.lojas')}}">+ Nova loja</a></li>
            @endif

             @if(Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
            <hr class="mx-4">
            @endif

            @if(Auth::guard('admin')->user()->RelationGrupo->ver_lojas == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_lojas == 1)
            <li><a class="nav-link" href="#">Ramos de atividade</a></li>
            @endif
          </ul>
        </li>
        @endif

        @if(Auth::guard('admin')->user()->RelationGrupo->ver_instituicoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1)
        <li class="nav-item dropdown {{ (Request::segment(2) == 'instituicoes' ? 'active' : '')}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-home-city-outline mdi-24px"></i> <span>Instituições</span></a>
          <ul class="dropdown-menu pb-2">
            @if(Auth::guard('admin')->user()->RelationGrupo->ver_instituicoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1)
            <li><a class="nav-link" href="{{route('exibir.instituicoes')}}">Ver todas</a></li>
            @endif
            @if(Auth::guard('admin')->user()->RelationGrupo->edit_instituicoes == 1)
            <li><a class="nav-link" href="{{route('adicionar.instituicoes')}}">+ Nova instituição</a></li>
            @endif
          </ul>
        </li>
        @endif

        @if(Auth::guard('admin')->user()->RelationGrupo->ver_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->ver_grupos_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1)
        <li class="nav-item dropdown {{ (Request::segment(2) == 'usuarios' ? 'active' : '')}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-account-multiple-outline mdi-24px"></i> <span>Usuários</span></a>
          <ul class="dropdown-menu pb-2">
            @if(Auth::guard('admin')->user()->RelationGrupo->ver_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1)
            <li><a class="nav-link" href="{{route('exibir.usuarios')}}"><b>Ver todos</b></a></li>
            @endif
            @if(Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1)
            <li><a class="nav-link" href="{{route('adicionar.usuarios')}}">+ Novo usuário</a></li>
            @endif

            @if((Auth::guard('admin')->user()->RelationGrupo->ver_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_usuarios == 1) || (Auth::guard('admin')->user()->RelationGrupo->ver_grupos_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1))
            <hr class="mx-4">
            @endif

            @if(Auth::guard('admin')->user()->RelationGrupo->ver_grupos_usuarios == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_grupos_usuarios == 1)
            <li><a class="nav-link" href="{{route('exibir.grupos')}}">Grupos de usuários</a></li>
            @endif
          </ul>
        </li>
        @endif

        @if(Auth::guard('admin')->user()->RelationGrupo->ver_plataforma == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_plataforma == 1)
        <li class="nav-item dropdown {{ (Request::segment(2) == 'plataforma' ? 'active' : '')}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-cogs mdi-24px"></i> <span>Plataforma</span></a>
          <ul class="dropdown-menu pb-2">                  
            <li><a href="{{route('plataforma.geral')}}" class="nav-link">Geral</a></li>
            <li><a href="#" class="nav-link">Pagamento</a></li>
            <li><a href="#" class="nav-link">Logística</a></li> 
            <li><a href="#" class="nav-link">E-mails transacionais</a></li>
            <li><a href="#" class="nav-link">Status</a></li>
          </ul>
        </li>
        @endif

        @if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1)
        <li class="nav-item dropdown {{ (Request::segment(2) == 'marketplace' ? 'active' : '')}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="mdi mdi-responsive mdi-24px"></i> <span>Marketplace</span></a>
          <ul class="dropdown-menu pb-2">                  
            <li><a href="{{route('exibir.navbar.marketplace')}}" class="nav-link">Navbar</a></li>
            <li><a href="{{route('exibir.menu.marketplace')}}" class="nav-link">Menu</a></li> 
            <li><a href="{{route('exibir.slider.marketplace')}}" class="nav-link">Slider</a></li> 
            <li><a href="{{route('exibir.sections.marketplace')}}" class="nav-link">Sections</a></li>
            <li><a href="{{route('exibir.footer.marketplace')}}" class="nav-link">Footer</a></li>
          </ul>
        </li>
        @endif
      @endif

    </ul>
  </aside>
</div>