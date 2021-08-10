<nav class="navbar navbar-expand-lg main-navbar shadow-none">
  <ul class="navbar-nav">
    <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg text-dark"><i class="fas fa-bars"></i></a></li>
    <li><a href="{{ route('home.mkt') }}" class="nav-link nav-link-lg text-dark" title="Sua loja" target="_blank"><i class="mdi mdi-store-outline mdi-24px"></i></a></li>
    <li><a href="javascript:void(0)" data-toggle="search" class="nav-link nav-link-lg text-dark"><i class="fas fa-search"></i></a></li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <!--
    <li class="dropdown dropdown-list-toggle">
      <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
        <i class="far fa-bell"></i>
      </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notificações
          <div class="float-right">
            <a href="#">Marcar todas como lidas</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-icon bg-primary text-white">
              <i class="fas fa-code"></i>
            </div>
            <div class="dropdown-item-desc">
              Template update is available now!
              <div class="time text-primary">2 Min Ago</div>
            </div>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">Ver todas <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>-->
    

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user text-dark">
      <img alt="image" src="{{ (isset(Auth::guard('admin')->user()->RelationImagens) ? asset('storage/app/'.Auth::guard('admin')->user()->RelationImagens->caminho.'?'.rand()) : asset('public/admin/img/user.png')) }}" class="rounded-circle mr-1 border" title="Imagem de perfil">
      <div class="d-sm-none d-lg-inline-block"></div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{route('perfil')}}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Perfil
        </a>
        <a href="{{route('atividades')}}" class="dropdown-item has-icon">
          <i class="fas fa-bolt"></i> Atividades
        </a>
        @if(Auth::guard('admin')->user()->RelationGrupo->ver_configuracoes == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_configuracoes == 1)
        <a href="{{route('configuracoes')}}" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Configurações
        </a>
        @endif
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="logout dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>

</nav>