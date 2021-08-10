  <!-- Header -->
  <header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
      <div class="wrap_header fixed-top" style="background-color: #fad70a!important">
        <div class="col-3 h-100">
          <a href="{{ route('home.mkt') }}" class="logo">
            <img src="<x-logomarca/>" alt="Logomarca">
          </a>
        </div>
        <div class="col-6">
          <form method="GET" action="{{ route('search.mkt') }}" autocomplete="off" class="my-auto w-100">
          <div class="input-group justify-content-center">
              <input type="search" name="pesquisa" class="pl-4 border-bottom col-10" placeholder="{{$navbar->search}}" style="border-top-left-radius: 23px; border-bottom-left-radius: 23px;" value="{{(isset($pesquisa) ? $pesquisa : null)}}">
              <div class="input-group-append ml-n4">
                <button class="btn bg-white border-bottom" style="border-top-right-radius: 23px; border-bottom-right-radius: 23px;">
                  <i class="mdi mdi-magnify mdi-24px"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-3 h-100">
          <div class="header-icons">
            <div class="header-wrapicon2">
              <div class="row js-show-header-dropdown header-icon1">
                <i class="mdi mdi-account-circle-outline mdi-dark fs-35" style="height: 27px;margin-top: -13px;"></i>
                <h6 class="ml-2 text-dark my-auto text-right" style="font-size: 0.94rem;">
                  <b>Olá, {{ (!empty(Auth::user()) ? explode(" ", Auth::user()->nome)[0] : 'faça seu login') }}</b>
                  @if(empty(Auth::user()))
                  <br>
                  <small>ou cadastre-se</small>
                  @else
                  <br>
                  <small>minha conta</small>
                  @endif
                </h6>
                <i class="mdi mdi-chevron-down p-1"></i>
              </div>
              <!-- Header cart noti -->
              @if(!empty(Auth::user()))
              <div class="header-perfil header-dropdown">
                <a href="{{route('pedidos.mkt')}}">
                  <span>Meus pedidos</span>
                </a>
                <br>
                <a href="{{route('perfil.mkt')}}">
                  <span>Meus dados</span>
                </a>
                <br>
                <a href="{{route('logout.mkt')}}">
                  <span>Sair</span>
                </a>
              </div>
              @else
              <div class="header-perfil header-dropdown">
                <div class="text-center">
                  <a href="{{route('login.mkt')}}" class="bg4 hov1 m-text3 trans-0-4 py-2 px-4">Entre agora</a>
                </div>
                <hr>
                <div class="row mx-auto text-center">
                  <a href="{{route('cadastro.mkt')}}" class="col-12 p-0">
                    <span class="mb-0">Você é novo aqui? <br> <b>Cadastre-se</b></span>
                  </a>
                </div>
                <hr>
                <div class="row">
                  <div class="mx-auto">
                    <a href="{{route('perfil.mkt')}}">
                      <small>Minha conta</small>
                    </a>
                  </div>
                  <span class="linedivide1 bg-secondary mx-0"></span>
                  <div class="mx-auto">
                    <a href="{{route('pedidos.mkt')}}">
                      <small>Meus pedidos</small>
                    </a>
                  </div>
                </div>
              </div>
              @endif
            </div>
            
            <span class="linedivide1 bg-secondary"></span>

            <a href="{{route('favoritos.mkt')}}" title="Acesse os seus favoritos">
              <i class="mdi mdi-heart-outline mdi-dark mr-3 fs-30"></i>
            </a>

            <div class="header-wrapicon2">
              <svg id="bhf_icon-cart" class="header-icon1 js-show-header-dropdown" viewBox="0 0 64 64" style="height: 26px; fill: #7d6015">
                <g id="icon-cart">
                  <path d="M60.55 23h-6.19L37.93 9.87C37.97 9.58 38 9.29 38 9c0-3.31-2.69-6-6-6C28.69 3 26 5.69 26 9c0 0.29 0.03 0.58 0.07 0.87L9.64 23H3.45C1.54 23 0 24.57 0 26.5S1.54 30 3.45 30h57.11C62.46 30 64 28.43 64 26.5S62.46 23 60.55 23zM16.04 23l11.95-9.55C29.05 14.41 30.46 15 32 15c1.55 0 2.95-0.59 4.01-1.55L47.96 23H16.04z"></path>
                  <path d="M7 60c0.23 1.58 1 4 5 4 0 0 37 0 40 0 4 0 4.77-2.41 5-4 1-7 4-28 4-28H3C3 32 6 53 7 60zM46 39.4C46 38.07 47.12 37 48.5 37s2.5 1.07 2.5 2.4v18.21C51 58.93 49.88 60 48.5 60S46 58.93 46 57.6V39.4zM35 39.4C35 38.07 36.12 37 37.5 37s2.5 1.07 2.5 2.4v18.21C40 58.93 38.88 60 37.5 60S35 58.93 35 57.6V39.4zM24 39.4C24 38.07 25.12 37 26.5 37s2.5 1.07 2.5 2.4v18.21C29 58.93 27.88 60 26.5 60S24 58.93 24 57.6V39.4zM13 39.4C13 38.07 14.12 37 15.5 37s2.5 1.07 2.5 2.4v18.21C18 58.93 16.88 60 15.5 60S13 58.93 13 57.6V39.4z"></path>
                </g>
              </svg>
              <span class="header-icons-noti">3</span>
              <!-- Header cart noti -->
              <div class="header-cart header-dropdown">
                <ul class="header-cart-wrapitem">
                  <li class="header-cart-item">
                    <div class="header-cart-item-img">
                      <img src="{{ asset('public/clients/images/item-cart-01.jpg') }}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt">
                      <a href="#" class="header-cart-item-name">
                        White Shirt With Pleat Detail Back
                      </a>
                      <span class="header-cart-item-info">
                        1 x $19.00
                      </span>
                    </div>
                  </li>
                  <li class="header-cart-item">
                    <div class="header-cart-item-img">
                      <img src="{{ asset('public/clients/images/item-cart-02.jpg') }}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt">
                      <a href="#" class="header-cart-item-name">
                        Converse All Star Hi Black Canvas
                      </a>
                      <span class="header-cart-item-info">
                        1 x $39.00
                      </span>
                    </div>
                  </li>
                  <li class="header-cart-item">
                    <div class="header-cart-item-img">
                      <img src="{{ asset('public/clients/images/item-cart-03.jpg') }}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt">
                      <a href="#" class="header-cart-item-name">
                        Nixon Porter Leather Watch In Tan
                      </a>
                      <span class="header-cart-item-info">
                        1 x $17.00
                      </span>
                    </div>
                  </li>
                </ul>
                <div class="header-cart-total">
                  Total: $75.00
                </div>
                <div class="header-cart-buttons">
                  <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="{{route('carrinho.mkt')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                      Ver carrinho
                    </a>
                  </div>
                  <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="{{route('carrinho.mkt')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                      Finalizar pedido
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
         </div>
      </div>

      @if(Request::segment(1) != "carrinho")
      <div class="bg1">
        <!-- Menu -->
        <div class="wrap_menu row">
          <nav class="menu col-2">
            <ul class="main_menu">
              <li class="ml-auto">
                <a href="javascript:void(0)">Todos departamentos</a>
                <ul class="sub_menu">
                  @foreach($categorias as $categoria)
                  <li><a href="{{url('categorias/'.$categoria->id)}}">{{$categoria->nome}}</a></li>
                  @endforeach
                </ul>
              </li>
            </ul>
          </nav>
          <nav class="menu col-10">
            <ul class="main_menu">
              @foreach($menu as $item)
              <li class="{{ (Request::segment(2) == $item->tagName ? 'sale-noti' : '')}}">
                <a href="{{$item->tagName}}">{{$item->nome}}</a>
              </li>
              @endforeach
            </ul>
          </nav>
        </div>
      </div>
      @endif
    </div>



    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
      <!-- Logo moblie -->
      <a href="index.html" class="logo-mobile">
        <img src="<x-logomarca/>" alt="IMG-LOGO">
      </a>

      <!-- Button show menu -->
      <div class="btn-show-menu">
        <!-- Header Icon mobile -->
        <div class="header-icons-mobile">
          <a href="#" class="header-wrapicon1 dis-block">
            <img src="#" class="header-icon1" alt="ICON">
          </a>

          <span class="linedivide2"></span>

          <div class="header-wrapicon2">
            <img src="#" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">0</span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
              <ul class="header-cart-wrapitem">
                <li class="header-cart-item">
                  <div class="header-cart-item-img">
                    <img src="#" alt="IMG">
                  </div>

                  <div class="header-cart-item-txt">
                    <a href="#" class="header-cart-item-name">
                      White Shirt With Pleat Detail Back
                    </a>

                    <span class="header-cart-item-info">
                      1 x $19.00
                    </span>
                  </div>
                </li>

                <li class="header-cart-item">
                  <div class="header-cart-item-img">
                    <img src="#" alt="IMG">
                  </div>

                  <div class="header-cart-item-txt">
                    <a href="#" class="header-cart-item-name">
                      Converse All Star Hi Black Canvas
                    </a>

                    <span class="header-cart-item-info">
                      1 x $39.00
                    </span>
                  </div>
                </li>

                <li class="header-cart-item">
                  <div class="header-cart-item-img">
                    <img src="#" alt="IMG">
                  </div>

                  <div class="header-cart-item-txt">
                    <a href="#" class="header-cart-item-name">
                      Nixon Porter Leather Watch In Tan
                    </a>

                    <span class="header-cart-item-info">
                      1 x $17.00
                    </span>
                  </div>
                </li>
              </ul>

              <div class="header-cart-total">
                Total: $75.00
              </div>

              <div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Ver carrinho
                  </a>
                </div>

                <div class="header-cart-wrapbtn">
                  <!-- Button -->
                  <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Finalizar pedido
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
      <nav class="side-menu">
        <ul class="main-menu">
          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <span class="topbar-child1">
              Free shipping for standard order over $100
            </span>
          </li>

          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <div class="topbar-child2-mobile">
              <span class="topbar-email">
                fashe@example.com
              </span>

              <div class="topbar-language rs1-select2">
                <select class="selection-1" name="time">
                  <option>USD</option>
                  <option>EUR</option>
                </select>
              </div>
            </div>
          </li>

          <li class="item-topbar-mobile p-l-10">
            <div class="topbar-social-mobile">
              <a href="#" class="topbar-social-item fa fa-facebook"></a>
              <a href="#" class="topbar-social-item fa fa-instagram"></a>
              <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
              <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
              <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>
          </li>

          <li class="item-menu-mobile">
            <a href="index.html">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Homepage V1</a></li>
              <li><a href="home-02.html">Homepage V2</a></li>
              <li><a href="home-03.html">Homepage V3</a></li>
            </ul>
            <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
          </li>

          <li class="item-menu-mobile">
            <a href="product.html">Shop</a>
          </li>

          <li class="item-menu-mobile">
            <a href="product.html">Sale</a>
          </li>

          <li class="item-menu-mobile">
            <a href="cart.html">Features</a>
          </li>

          <li class="item-menu-mobile">
            <a href="blog.html">Blog</a>
          </li>

          <li class="item-menu-mobile">
            <a href="about.html">About</a>
          </li>

          <li class="item-menu-mobile">
            <a href="contact.html">Contact</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>