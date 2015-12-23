<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="{{ route('auth.profile') }}" class="media-left"><img src="{{ asset('theme/img/face15.jpg') }}" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{ auth()->user()->name }}</span>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="{{ route('auth.profile') }}"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Principal</span> <i class="icon-menu" title="" data-original-title="Main pages"></i></li>
                    @if(auth()->user()->hasRole('administrador'))
                    <li class="active"><a href="{{ route('home') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="{{ route('product.choose') }}"><i class="icon-gas"></i> <span>Vender gasolina</span></a>
                    </li>
                    <li>
                        <a href="{{ route('consumo.seleccion.cliente') }}"><i class="icon-gas"></i> <span>Consumir gasolina</span></a>
                    </li>
                    <li>
                        <a href="#" class="has-ul"><i class="icon-copy"></i> <span>Catálogos</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('cliente.index') }}"><i class="icon-users text-primary-400"></i> Clientes</a></li>
                            <li><a href="{{ route('tipo_pregunta.index') }}"><i class="icon-question6 text-warning-300"></i>Tipos de preguntas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="icon-chart"></i> <span>Reportes</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('ordenes') }}">Ordenes</a></li>
                            <li><a href="{{ route('consumos.clientes') }}">Consumos de cliente</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="has-ul"><i class="icon-key"></i> <span>Seguridad</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('usuario.index') }}"><i class="icon-user"></i> Usuarios</a></li>
                            <li><a href="{{ route('rol.index') }}"><i class="icon-users2"></i> Roles</a></li>
                            <li><a href="{{ route('permiso.index') }}"><i class="icon-hand"></i> Permisos</a></li>
                        </ul>
                    </li>
                    @elseif(auth()->user()->hasRole('cliente'))
                        <li class="active"><a href="{{ route('home') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>