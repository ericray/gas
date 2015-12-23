<div class="navbar navbar-default header-highlight">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="icon-logo">{!! Html::image(asset('theme/img/gas_station.png'),'logo',['style' => 'width:16px']) !!} Gasolinera</span>
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if(auth()->user()->hasRole('administrador'))
            <li>
                <a href="{{ route('cart.detail') }}">
                    <i class="icon-cart"></i>
                    @if(count(\Cart::contents()) > 0)
                        <span class="badge bg-warning">{{ count(\Cart::contents()) }}</span>
                    @endif
                </a>
            </li>
            @endif
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('theme/img/face15.jpg') }}" alt="">
                    <span>{{ auth()->user()->name }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('auth.profile') }}"><i class="icon-user-plus"></i> Mi perfil</a></li>
                    @if(auth()->user()->hasRole('cliente'))
                        <li><a href="{{ route('cart.account') }}"><i class="icon-coins"></i> Mi cuenta</a></li>
                    @endif
                    <li class="divider"></li>
                    <li><a href="{{ route('auth.logout') }}"><i class="icon-switch2"></i> Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>