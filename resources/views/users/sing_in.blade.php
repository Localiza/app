<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

  <title>Guia Localiza</title>

  <link rel="stylesheet" href="{{ asset('assets/lib/fontawesome/css/font-awesome.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/quirk.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

  <script src="{{ asset('assets/lib/modernizr/modernizr.js') }}"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
    <div class="panel-heading">
      <h1>Guia Localiza ADMIN</h1>
      <h4 class="panel-title">Bem Vindo! faça seu login.</h4>
    </div>
    @if(count($errors) > 0)
      @foreach($errors->all() as $e)
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><i class="icon icon-exclamation"></i> Opps!</strong> {{ $e }}
        </div>
      @endforeach
    @endif
    <div class="panel-body">
      <form action="/auth/login" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="{{ old('email') }}">
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Digite sua senha">
          </div>
        </div>
        <div class="form-options"><a href="" class="forgot">Esqueceu sua senha?</a>
          <div class="pull-right remember"><label><input type="checkbox" name="remember"> <span>Remember Me</span></label></div>
        </div>
        <hr>
        <div class="form-group">
          <button class="btn btn-success btn-quirk btn-block">Entrar</button>
        </div>
      </form>
      <hr class="invisible">

    </div>
  </div><!-- panel -->

</body>
</html>
