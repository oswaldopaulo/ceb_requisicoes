<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Sistema de Gerenciamento Basico</title>
    <link href="{{ asset ('css/styles_alt.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('vendor/datatables-1.10.21/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset ('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset ('vendor/fontawesome-free-5.13.1-web/js/all.min.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/datatables.min.css') }}"/>
    <script src="{{ asset ('vendor/bootstrap-4.5.0-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset ('js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/datatables-1.10.21/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-1.10.21/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js') }}"></script>
    <link href="{{ asset ('vendor/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"/>

    <link href="{{ asset('vendor/select2-4.1.0/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2-4.1.0/dist/js/select2.min.js') }}"></script>


{{--    @if (Request::path() == 'requisicoes')--}}
{{--        <script src="{{ asset('assets/demo/datatables-requisicoes.js') }}"></script>--}}

{{--    @elseif (Request::path() == '/')--}}
{{--        <script src="{{ asset('assets/demo/datatables-requisicoes.js') }}"></script>--}}
{{--    @else--}}
{{--        <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>--}}
{{--    @endif--}}

    <script type="text/javascript" src="{{ asset('assets/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset ('assets/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset ('assets/datatables.min.js')}}"></script>


</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('assets/img/ceb.png') }}" width="85px" height="auto"> </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!--
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
        -->
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ url('usuarios/editar/' .  Auth::user()->id) }}">Meus Dados</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>


            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>

                    @if(Auth::user()->tipo==1)
                        <div class="sb-sidenav-menu-heading">Manuntenções</div>


                        <a class="nav-link" href="{{ url('usuarios') }}"><i class="fas fa-user fa-fw"></i>Usuários</a>

                    @endif
                    <div class="sb-sidenav-menu-heading">Menu rápido</div>
                    <!--
							<a class="nav-link" href="{{ url('orcamentos')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Orçamentos
                            </a>
							-->

                    <a class="nav-link" href="{{ url('requisicoes')}}">
                        <div class="sb-nav-link-icon"><i class="far fa-calendar-alt"></i></div>
                        Requisições
                    </a>


                    <a class="nav-link" href="{{ url('apontamentos')}}">
                        <div class="sb-nav-link-icon"><i class="far fa-calendar-alt"></i></div>
                        Apontamentos
                    </a>



                    <!--
                         <div class="sb-sidenav-menu-heading">Atualizações</div>


                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cadastros
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('cadastros/departamentos')}}"><div class="sb-nav-link-icon"><i class="b-nav-link-icon fas fa-table"></i></div>Departamentos</a>
                                    <a class="nav-link" href="{{ url('cadastros/categorias')}}"><div class="sb-nav-link-icon"><i class="b-nav-link-icon fas fa-table"></i></div>Categorias</a>
                                </nav>
                            </div>

                         -->


                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: {{ Auth::user()->username }}</div>
                <div class="small">Laravel: {{ App::VERSION() }} PHP: {{  phpversion() }}</div>


            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        @yield('content')
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Oswaldo Paulo</div>
                    <div>
                        <a href="{{ url('privacy') }}">Privacy Policy</a>
                        &middot;
                        <a href="{{ url('privacy') }}">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>



</body>
</html>
