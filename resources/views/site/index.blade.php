@extends('layouts.site')

@section('body')
    <div class="breaker"></div>
    <article class="home">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <a href="/"><img class="img-responsive center-block logo" src="{{ asset("site/img/logo.png") }}" alt="Guia Localiza" title="Guia Localiza"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                    <form name="search" action="/search" method="get" >
                        {{--{!! Form::token() !!}--}}
                        <div class="row">
                            <div class="col-xs-12 col-sm-5 col-md-6 col-lg-6">
                                <input type="text" name="busca" id="busca" placeholder="Pesquisa por empresa ou seguimento" value="{{ isset($_GET['busca']) ? $_GET['busca'] : "" }}" required />
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3" >
                                <select class="form-control" onchange="next()" id="cidade" name="cidade" required>
                                    <option value="">Selecione a cidade</option>
                                    <?php if(isset($cidBase)) { ?>
                                    @foreach($cidBase as $cidade)
                                        <option value="{{$cidade->id}}">{{$cidade->name . " - " . $cidade->estado->uf}}</option>
                                    @endforeach
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <button class="submit"><i class="glyphicon glyphicon-search"></i> LOCALIZAR</button>
                                {{--<input type="submit" name="send" value="LOCALIZAR" class="submit">--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /container -->
    </article>

    <article class="more">
        <div class="row">
            <div class="container">
                <div class="col-xs-12">
                    <h2>OS MAIS PESQUISADOS</h2>
                    <div class="moreviews">
                        @foreach($empresas as $item)
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img class="img-responsive" src="{!! $item->logo ? asset("uploads/empresas/".$item->logo) : asset("assets/default.jpg")  !!}" alt="" title="{{ $item->name }}">
                            </div>
                        @endforeach
                    </div><!-- /moreviews -->
                </div>
            </div>
        </div>
    </article>
@endsection
