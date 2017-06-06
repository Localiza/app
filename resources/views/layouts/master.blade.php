<?php
use Illuminate\Support\Facades\Route;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="{{ asset("assets/images/favicon.png") }}" type="image/png">-->

    <title>Guia Localiza - ADMIN</title>

    <link rel="stylesheet" href="{{ asset("assets/lib/fontawesome/css/font-awesome.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/jquery-toggles/toggles-full.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/select2/select2.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/chosen/chosen.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/dropzone/dropzone.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/chosen/docsupport/prism.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/quirk.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/app.css") }}">


    <script src="{{ asset("assets/lib/modernizr/modernizr.js") }}"></script>
    <script src="{{ asset("assets/js/i7creative.js") }}"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset("assets/lib/html5shiv/html5shiv.js") }}"></script>
    <script src="{{ asset("assets/lib/respond/respond.js") }}"></script>
    <![endif]-->
    <script src="{{ asset("assets/lib/jquery/jquery.js") }}"></script>
    <script src="{{ asset("assets/lib/jquery-ui/jquery-ui.js") }}"></script>
    <script src="{{ asset("assets/lib/bootstrap/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/lib/jquery-toggles/toggles.js") }}"></script>
    <script src="{{ asset("assets/lib/datatables/jquery.dataTables.js") }}"></script>
    <script src="{{ asset("assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js") }}"></script>
    <script src="{{ asset("assets/lib/chosen/chosen.jquery.js") }}"></script>
    <script src="{{ asset("assets/lib/chosen/docsupport/prism.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.maskMoney.js") }}"></script>
</head>

<body>

<header>
    <div class="headerpanel">

        <div class="logopanel">
            <h2><a href="index.html">Guia Localiza</a></h2>
        </div><!-- logopanel -->

        <div class="headerbar">
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-logged" data-toggle="dropdown">
                                <img src="{{ asset("assets/images/photos/loggeduser.png") }}" alt="" />
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/auth/logout"><i class="glyphicon glyphicon-log-out"></i> Sair do Sistema</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->
        </div><!-- headerbar -->
    </div><!-- header-->
</header>

<section>
    <div class="leftpanel">
        <div class="leftpanelinner">
            <!-- ################## LEFT PANEL PROFILE ################## -->
            <div class="media leftpanel-profile">
                <div class="media-left">
                    <a href="#">
                        <img src="{{ asset("assets/images/photos/loggeduser.png") }}" alt="" class="media-object img-circle">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"> {{ Auth::user()->name }} <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
                    <span>Administrador</span>
                </div>
            </div><!-- leftpanel-profile -->

            <ul class="nav nav-tabs nav-justified nav-sidebar">
                <li class="tooltips active" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
            </ul>

            <div class="tab-content">

                <!-- ################# MAIN MENU ################### -->

                <div class="tab-pane active" id="mainmenu">
                    <h5 class="sidebar-title">Menu principal</h5>
                    <ul class="nav nav-pills nav-stacked nav-quirk">
                        <li class="nav-parent">
                            <a href=""><i class="fa fa-industry"></i> <span>Empresas</span></a>
                            <ul class="children">
                                <li><?= link_to_route('empresa.index', $title = "Lista de empresas", $parameters = array(), $attributes = array()); ?></li>
                            </ul>
                        </li>
                        <li class="divider paddingtop15"></li>
                        <li class="nav-parent  {{ Request::is( '/categoria') ? 'active' : '' }}">
                            <a href=""><i class="fa fa-navicon"></i> <span>Classificação</span></a>
                            <ul class="children">
                                <li ><?= link_to_route('subcategoria.index', $title = "Sub-Categoria", $parameters = array(), $attributes = array()); ?></li>
                                <li class="{{ Request::is( '/categoria') ? 'active' : '' }}"><?= link_to_route('categoria.index', $title = "Categoria", $parameters = array(), $attributes = array()); ?></li>
                            </ul>
                        </li>

                        <li class="nav-parent">
                            <a href=""><i class="fa fa-globe"></i> <span>Localização</span></a>
                            <ul class="children">
                                <li><a href="{{action('LogradouroController@filtro', $params= array())}}">Logradouros</a> </li>
                                <li><a href="{{action('BairroController@filtro', $params= array())}}">Bairros</a> </li>
                                <li><a href="{{action('CepController@filtro', $params= array())}}">CEPs</a> </li>
                                <li><a href="{{action('CidadeController@filtro', $params= array())}}">Cidades</a> </li>
                                <li><?= link_to_route('estado.index', $title = "Estados", $parameters = array(), $attributes = array()); ?></li>
                            </ul>
                        </li>
                        <li class="divider paddingtop15"></li>
                        <li class="nav  {{ Request::is( '/contato') ? 'active' : '' }}">
                            <a href="{{action('ContatoController@index', $params= array())}}"><i class="fa fa-mail-forward"></i> <span>Formulário de contato</span></a>
                        </li>
                        <li class="nav  {{ Request::is( '/usuarios') ? 'active' : '' }}">
                            <a href="{{action('UsersController@index', $params= array())}}"><i class="fa fa-users"></i> <span>Usuarios</span></a>
                        </li>
                    </ul>
                </div><!-- tab-pane -->
            </div><!-- tab-content -->
        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">
        <div class="contentpanel">
            @yield('content')
        </div><!-- contentpanel -->
    </div><!-- mainpanel -->
</section>

<script src="{{ asset("assets/js/quirk.js") }}"></script>
<script src="{{ asset("assets/lib/jquery-toggles/toggles.js") }}"></script>
<script src="{{ asset("assets/lib/dropzone/dropzone.js") }}"></script>
<script src="{{ asset("assets/lib/select2/select2.js") }}"></script>
<script src="{{ asset("assets/lib/jquery-maskedinput/jquery.maskedinput.js") }}"></script>
<script>
    $( document ).ready(function() {
        $('.dataTable').DataTable();
        $('.currency').maskMoney();
        $(".tags").select2({ tags: true });
        $('.cep').mask('99999-999');
        $('.phone').mask('(99) 9999-9999');
        $('.dropzone').dropzone();
    });
</script>
</body>
</html>
