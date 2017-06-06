@extends('layouts.master')

@section('content')


<link rel="stylesheet" href="{{ asset("assets/lib/dropzone/dropzone.css") }}">
<script src="{{ asset("assets/masonry.pkgd.min.js") }}"></script>

<script src="{{ asset("assets/js/jquery.mousewheel-3.0.6.pack.js") }}"></script>
<link rel="stylesheet" href="{{ asset("assets/lib/fancybox/jquery.fancybox.css") }}">
<script src="{{ asset("assets/lib/fancybox/jquery.fancybox.js") }}"></script>

<div class="panel">
    <div class="panel-body">
        <h1>{{$empresa->name}} <a href="{{ url('/empresa') }}" class="btn btn-primary pull-right">Voltar</a></h1>
        <div class="col-lg-12 col-md-12 paddingtop15 tabs">
            <ul class="nav nav-tabs nav-line">
                <li class="active"><a href="#galeria" data-toggle="tab" aria-expanded="true"><strong>Galeria de Imagens</strong></a></li>
                <li class=""><a href="#banner" data-toggle="tab" aria-expanded="false"><strong>Banners</strong></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="galeria">
                    <div class="col-md-12"><h3><i class="fa fa-picture-o"></i> Galeria de imagens</h3></div>
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-upload"></i> Upload de imagens</h4>
                                <p>Selcione as imagens para upload.<br>Tamanho máximo de 2Mb</p>
                            </div>
                            <div class="panel-body bg-success">
                                <form action="/empresa/{{$empresa->id}}/upload" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                                    {!! Form::token() !!}
                                </form>
                            </div>
                        </div><!-- panel -->
                        <hr>
                    </div>
                    <div class="col-md-9">

                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-picture-o"></i> Galeria</h4>
                            </div>
                            <div class="panel-body">

                                <div class="gridGaleria">
                                    @foreach($galeria as $item)
                                        <div id="imagem_{{$item->id}}" class="grid-item" style="border: 1px #cccccc solid; padding: 3px; margin: 3px; border-radius: 3px;">
                                            <a class="fancybox" rel="group" href="{!! asset("uploads/empresas/$empresa->id/galeria/$item->imagem") !!}">
                                                <img width="150px" src="{!! asset("uploads/empresas/$empresa->id/galeria/$item->imagem") !!}">
                                            </a>
                                            <div style="position: absolute; left: 5px; top: 5px; background-color: #880000; padding: 0 2px 0 2px;">
                                                <a href="javascript:" onclick="deletaImagem({{$item->id}})" style="color: #ffffff"> <i class="fa fa-trash-o"></i></a>
                                            </div>
                                            <div id="loading_{{$item->id}}" style="position: absolute; left: 50%; top: 50%; margin-left: -16px; margin-top: -16px; border: 1px solid #ffffff; padding: 3px; border-radius: 3px; display: none ">
                                                <img src="{!! asset("assets/images/loading.gif") !!}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- panel -->
                    </div>
                </div>
                <div class="tab-pane " id="banner">
                    <div class="col-md-12"><h3><i class="fa fa-list"></i> Banners</h3></div>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-upload"></i> Upload de banner</h4>
                                <p>Banner: 370x120</p>
                            </div>
                            <div class="panel-body bg-success">
                                {!! Form::open(['url' => 'banners', 'class' => 'form-horizontal','files' => true]) !!}
                                    {!! Form::text('tipo', 1, ['class' => 'form-control','style'=>'display:none']) !!}
                                    {!! Form::text('empresa_id', $empresa->id, ['class' => 'form-control','style'=>'display:none']) !!}
                                    <div class="col-md-12 padding10">
                                        {!! Form::file('imagem',['class' => 'form-control','accept'=>".jpg,.png,.gif"]) !!}
                                    </div>
                                {!! Form::submit('Upload', ['class' => 'btn btn-success form-control']) !!}
                                {!! Form::close() !!}
                            </div>
                            <hr>
                        </div><!-- panel -->
                    </div>
                    <div class="col-md-9">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-picture-o"></i> Banners</h4>

                            </div>
                            <div class="panel-body">
                                <div class="gridBanners">
                                    @foreach($banners as $item)
                                        <div id="banner_{{$item->id}}" class="grid-item" style="border: 1px #cccccc solid; padding: 3px; margin: 3px; border-radius: 3px;">
                                            <a class="fancybox" rel="group" href="{!! asset("uploads/empresas/banners/$item->imagem") !!}">
                                                <img width="150px" src="{!! asset("uploads/empresas/banners/$item->imagem") !!}">
                                            </a>
                                            <div style="position: absolute; left: 5px; top: 5px; background-color: #880000; padding: 0 2px 0 2px;">
                                                <a href="javascript:" onclick="deletaBanner({{$item->id}})" style="color: #ffffff"> <i class="fa fa-trash-o"></i></a>
                                            </div>
                                            <div id="loadingB_{{$item->id}}" style="position: absolute; left: 50%; top: 50%; margin-left: -16px; margin-top: -16px; border: 1px solid #ffffff; padding: 3px; border-radius: 3px; display: none ">
                                                <img src="{!! asset("assets/images/loading.gif") !!}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- panel -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var deletaImagem = function(id){
        $("#loading_"+id).fadeIn(200, function () {
            $.ajax({
                url: "/empresa/assets/"+id+"/del",
                type: "GET",
                success: function(result){
                     if(result=="1"){
                         $('#imagem_'+id).fadeOut(300,function(){
                             $('.gridGaleria').masonry({
                                 itemSelector: '.grid-item'
                             });
                         });
                     }
                }
            });
        });
    }
    var deletaBanner = function(id){
        $("#loadingB_"+id).fadeIn(200, function () {
            $.ajax({
                url: "/empresa/banner/"+id+"/del",
                type: "GET",
                success: function(result){
                     if(result=="1"){
                         $('#banner_'+id).fadeOut(300,function(){
                             $('.gridBanners').masonry({
                                 itemSelector: '.grid-item'
                             });
                         });
                     }
                }
            });
        });
    }
    $(document).ready(function() {
        $('#dropzone').on("success", function(file) {
            console.log("ok");
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href") // activated tab

            if(target=="#banner"){
                $('.gridBanners').masonry();
            }

            if(target=="#galeria"){
                $('.gridGaleria').masonry();
            }
        });
        $('.gridGaleria').masonry();
        $(".fancybox").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
    });
</script>
@endsection
