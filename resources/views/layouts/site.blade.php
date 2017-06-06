<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="{{ asset("assets/images/favicon.png") }}" type="image/png">-->

    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,500,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/app.css") }}">
    <link rel="stylesheet" href="{{ asset("site/slick/slick.css") }}">
    <link rel="stylesheet" href="{{ asset("site/slick/slick-theme.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/lib/fontawesome/css/font-awesome.css") }}">

    <title>Guia Localiza - Sua agenda online</title>
    <script src="{{ asset("site/js/jquery-2.1.4.min.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap.js") }}"></script>
    <script src="{{ asset("site/slick/slick.min.js") }}"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.moreviews').slick({
                autoplay: true,
                dots: true,
                slidesToShow: 4,
                slidesToScroll: 4
            });
        });
    </script>
</head>
<body>
<div class="wrap">
    <article class="top">
        <div class="top-border">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li style="margin-right: 5px"><a href="/">Inicio </a><span>|</span></li>
                                        <li style="margin-right: 5px"><a href="#">Sobre o Guia </a><span>|</span></li>
                                        <li style="margin-right: 5px"><a href="#">Anúncie </a><span>|</span></li>
                                        <li style="margin-right: 5px"><a href="/contato/create">Fale Conosco</a><span>|</span></li>
                                        <li style="margin-right: 5px"><a href="#">Cadastre Sua Empresa</a></li>
                                        <!--
                                        <li class="active"><a href="#">Sobre o Guia</a><span>|</span></li>
                                        <li><a href="#">Planos</a><span>|</span></li>
                                        <li><a href="#">Sugerir Telefone</a><span>|</span></li>
                                        <li><a href="#">Atualizar Telefone</a><span>|</span></li>-->
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div><!-- /container -->
        </div>
    </article>


    @yield('body')

</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                {{--<ul>--}}
                    {{--<li><a href="#">Sobre o Guia</a><span>|</span></li>--}}
                    {{--<li><a href="/sugerir">Sugerir Telefone</a><span>|</span></li>--}}
                    {{--<li><a href="/atualizar">Atualizar Telefone</a><span>|</span></li>--}}
                    {{--<li><a href="/contato/create">Fale Conosco</a></li>--}}
                {{--</ul>--}}

                <div class="copy">
                    <p>&copy; 2015 Copyright 2015 - Todos os direitos reservados<br>
                        Desenvolvimento: <a href="http://i7creative.com.br" title="i7 Creative | Soluções Web" target="_blanck">i7 Creative Tecnologia</a>
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 app">
                <span>Aplicativo disponivel para:</span>
                <div>
                    <!--<a href="" title="App para IOS" class="apple"><img class="img-responsive" src="{{ asset("site/img/apple-store.png") }}" alt="Apple Store" title="App para IOS" ></a>-->
                    <a target="_blank" href="https://play.google.com/store/apps/details?id=br.com.i7creative.guialocaliza&hl=pt_BR" title="App para Android"><img class="img-responsive" src="{{ asset("site/img/google-play.png") }}" alt="Google Play" title="App para Android" ></a>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- /container -->
</footer>
<script src="{{ asset("assets/lib/jquery-maskedinput/jquery.maskedinput.js") }}"></script>
<script>
    var $header = $('.header');
    $(document).on('scroll', function () {
        if ($header.height() <= $(window).scrollTop()) {
            $header.addClass('fixar').addClass('slideDown');
        } else {
            $header.removeClass('fixar').removeClass('slideDown');
        }
    });

    var cidade_id = getCookie('cid_id');
    $("#cidade").val((cidade_id ? cidade_id : "") );

    function next() {
        var cid_id = $("#cidade").val();

        if (cid_id > 0) {
            document.cookie = 'cid_id=' + cid_id;
        }
    }

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    function show_phone(id){
        var phone = $('.complete_phone_'+id+'').html();
        $('.phone_'+id+' span').html(phone);
        atualizaClicks(id);
    }

    function atualizaClicks(id){
        $.ajax({
            method: "GET",
            url: "/increment/"+id
        });
    }

    var hide_button = function(cmp){
        $(cmp).fadeOut(500);
    };

    $( document ).ready(function() {
        $('.phone').mask('(99) 9999-9999');
    });
</script>
</body>
</html>