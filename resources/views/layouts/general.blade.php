@extends('layouts.site')

@section('body')
    <article class="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0 col-lg-2 col-lg-offset-0">
                    <a href="/"><img class="img-responsive center-block logo" src="{{ asset("site/img/logo-branca.png") }}" alt="Guia Localiza" title="Guia Localiza"></a>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                    <form name="search" action="/search" method="get" >
                        {{--{!! Form::token() !!}--}}
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                                <input type="text" name="busca" id="busca" placeholder="Faça sua pesquisa..." value="{{ isset($_GET['busca']) ? $_GET['busca'] : "" }}" required />
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3" >
                                <select class="form-control" onchange="next()" id="cidade" name="cidade" required>
                                    <option value="-1">Selecione a cidade</option>
                                    <?php if(isset($cidBase)) { ?>
                                    @foreach($cidBase as $cidade)
                                        <option value="{{$cidade->id}}">{{$cidade->name . " - " . $cidade->estado->uf}}</option>
                                    @endforeach
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                {{--<input type="submit" name="send" value="LOCALIZAR" class="submit">--}}
                                <button class="submit"><i class="glyphicon glyphicon-search"></i> LOCALIZAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /container -->
    </article>

    @yield('content')
@endsection