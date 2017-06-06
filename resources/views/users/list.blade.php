@extends('layouts.master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="/"><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a href="">Usuários</a></li>
        <li class="active">Lista</li>
        <a href="{{url('usuarios/create')}}" class="btn btn-primary btn-quirk btn-stroke pull-right">Novo usuário</a><br><br>
    </ol>
    @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('type') }} alert-dismissable"><span class="bold"><i class="icon fa fa-check"></i>{{ Session::get('message') }}</span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
    @endif
    @foreach($usuarios as $item)
        <div class="panel panel-profile list-view" id="usuarios_{{ $item->id }}">
            <div class="panel-heading">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="{{ asset("assets/images/photos/user4.png") }}" alt="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $item->name }}</h4>
                        <p class="media-usermeta"><i class="glyphicon glyphicon-briefcase"></i> Administrador</p>
                    </div>
                </div><!-- media -->
            </div>
            <div class="panel-body people-info">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="info-group" style="min-height: 80px;">
                            <label>Email</label>
                            {{ $item->email }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="info-group" style="min-height: 80px;" >
                            <label>Ativo</label>
                            <div class="toggle-wrapper" id="usuario_{{ $item->id }}">
                                <div class="toggle toggle-light success ativo{{$item->id}}"></div>
                            </div>
                            <script>
                                $('.ativo{{$item->id}}').toggles({
                                    on: {{ $item->active }},
                                    text: {
                                        on: 'SIM', // text for the ON position
                                        off: 'NÂO' // and off
                                    },
                                    height: 26
                                }).on('toggle', function (e, active) {
                                    activeReg('usuarios', {{$item->id}}, active);
                                });
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="info-group" style="min-height: 80px; padding-bottom: 8px;">
                            <label>Ações</label>
                            <div class="social-account-list">
                              <a href="{{ url('usuarios/'.$item->id.'/edit/') }}" class="text-primary" style="margin-left: 35%; float: left;"><i class="fa fa-edit" style="margin-right: 10px; font-size: 24px; float: left; margin-top: 1px;"></i></a>
                              <a href="" onclick="openModalDel('usuarios',{{ $item->id }}); return false;" class="text-danger"><i class="fa fa-trash-o" style="font-size: 23px; float: left;"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
        </div><!-- panel -->
    @endforeach
    <!-- content goes here... -->
@stop
