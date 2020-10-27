<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Zona wifi</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="modulo" content="@if( Auth::user()->modulo_id) {{Auth::user()->modulo->NombreModulo}}@endif">
    <!--link Internet-->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconkit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-jvectormap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toast.min.css') }}" rel="stylesheet">



    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/modernizr-2.8.3.min.js') }}"></script>

</head>
<body>

    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        <div class="header-search">
                            <div class="input-group">
                                <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>

                            </div>
                        </div>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <div class="dropdown">

                            <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                                <h4 class="header">Notifications</h4>
                                <div class="notifications-wrap">
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-check"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Invitation accepted</span>
                                            <span class="media-content">Your have been Invited ...</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">

                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Steve Smith</span>
                                            <span class="media-content">I slowly updated projects</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-calendar"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">To Do</span>
                                            <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="footer"><a href="javascript:void(0);">See all activity</a></div>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="dropdown-menu dropdown-menu-right menu-grid" aria-labelledby="menuDropdown">
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="ik ik-bar-chart-2"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Message"><i class="ik ik-mail"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Accounts"><i class="ik ik-users"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Sales"><i class="ik ik-shopping-cart"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Purchase"><i class="ik ik-briefcase"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Pages"><i class="ik ik-clipboard"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Chats"><i class="ik ik-message-square"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Contacts"><i class="ik ik-map-pin"></i></a>

                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Events"><i class="ik ik-calendar"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Notifications"><i class="ik ik-bell"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="More"><i class="ik ik-more-horizontal"></i></a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="img/logueado.png" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <a class="dropdown-item"><i class="ik ik-user dropdown-icon"></i>{{ Auth::user()->username  }} </a>
                                <a class="dropdown-item" href="{{Route('cuenta.index')}}"><i class="ik ik-settings dropdown-icon"></i> Mi Cuenta</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ik ik-power dropdown-icon"></i> {{ __('Logout') }}

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form></a>
                            </div>
                        </div>
                        @endguest

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand">

                        <span class="text">Zonas wifi Kalu</span>
                    </a>
                    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">

                            <div class="nav-item active">
                                <a href="{{route('home')}}" class="text-white" ><i class="ik list ik-list
                                    "></i><span>Inicio</span></a>
                                </div>
                                @can('Sección de configuración')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)" class="text-white" ><i class="ik ik-settings"></i><span>Administración</span></a>
                                    <div class="submenu-content">
                                        @can('Ver datos de la empresa')
                                        <a href="{{route('empresa.index')}}" class="menu-item">Información empresarial</a>
                                        @endcan
                                        @can('Ver roles')

                                        <a href="{{route('rol.index')}}" class="menu-item">Roles</a>@endcan
                                        @can('Ver usuarios')
                                        <a href="{{route('usuario.index')}}" class="menu-item">Usuarios</a>
                                        @endcan


                                    </div>
                                </div>
                                @endcan
                                <!--
                                @can('Sección de registro')
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class=" ik edit ik-edit"></i><span>Registro</span></a>
                                    <div class="submenu-content">

                                    @can('Ver barrios')
                                        <a href="{{route('barrio.index')}}" class="menu-item">Barrios</a>
                                        @endcan
                                        @can('Ver beneficiarios')

                                        <a href="{{route('beneficiario.index')}}" class="menu-item">Beneficiarios</a>@endcan
                                    </div>
                                    </div>
                                    @endcan
                                -->

                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)" class="text-white" ><i class="ik bar-chart ik-bar-chart"></i><span>Wifi Rondón</span></a>
                                    <div class="submenu-content">
                                        
                                        
                                        <a href="{{route('informe.index')}}" class="menu-item">Listado de conexiones</a>
                                        <a href="graficaRondon" class="menu-item">Estadística general</a>
                                        <a href="{{route('filtroRondonGeneral.index')}}" class="menu-item">Filtro general rango de fechas</a>
                                        

                                    </div>
                                </div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)" class="text-white" ><i class="ik wifi ik-wifi
                                        "></i><span>Wifi Tame</span></a>
                                        <div class="submenu-content">
                                            
                                            <a href="listadoConexionTame" class="menu-item">Listado de conexiones</a>
                                            <a href="graficaGeneralTame" class="menu-item">Estadística general</a>
                                             <a href="{{route('filtroTameGeneral.index')}}" class="menu-item">Filtro general rango de fechas</a>
                                            

                                        </div>
                                    </div>
                                    
                                    <!--
                                    @can('Sección de informes')
                                    <div class="nav-item has-sub">

                                        <a href="javascript:void(0)" class="text-white"><i class="ik file-text ik-file-text"></i><span>Informes</span></a>
                                        <div class="submenu-content">
                                            <!--

                                            @can('Ver infome múltiple')
                                            <a href="{{route('informeExcel.index')}}" class="menu-item">Informe múltiple excel</a>
                                            @endcan
                                            @can('Ver beneficiario sin ayuda')
                                            <a href="{{route('beneficiarioSinAyuda.index')}}" class="menu-item">Beneficiario sin ayudas</a>
                                            @endcan
                                        


                                    </div>
                                </div>@endcan
                            -->

                        </nav>
                    </div>
                </div>
            </div>

            @yield('content')



            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2019 Codijar.</span>

                </div>
            </footer>

        </div>
    </div>

    <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="quick-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                                <div class="input-wrap">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container">
                        <div class="apps-wrap">
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>
</html>