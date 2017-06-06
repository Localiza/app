@extends('layouts.master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="/"><i class="fa fa-home mr5"></i> Home</a></li>
        <li><a href="">Usuários</a></li>
        <li class="active">Adicionar</li>
        <a href="{{url('usuarios')}}" class="btn btn-warning btn-quirk btn-stroke pull-right">Voltar a Lista</a><br><br>
    </ol>

    <div class="col-sm-12 col-md-8 col-lg-6">
        <div class="panel">
            <div class="panel-heading nopaddingbottom">
                @if(!empty($usuario))
                    <h4 class="panel-title">Editar um Usuário</h4>
                    <p>Por favor informe os dados para realizar a edição deste Usuário.</p>
                @else
                    <h4 class="panel-title">Cadastrar um novo Usuário</h4>
                    <p>Por favor informe os dados para realizar o cadastro de Usuário.</p>
                @endif
            </div>
            <div class="panel-body">
                <hr>
                <form action="/usuarios/{{ !empty($usuario) ? $usuario->id : '' }}" class="form-horizontal form_validate" method="post">
                  @if(!empty($usuario))
                      <input type="hidden" name="_method" value="PUT">
                  @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nome Completo <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" placeholder="Digite seu nome..." required value="{{ !empty($usuario) ? $usuario->name : old('name') }}" />
                            <span class="text-danger">{{ ($errors->first('name') ? $errors->first('name') : '') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail..." required value="{{ !empty($usuario) ? $usuario->email : old('email') }}" />
                            <span class="text-danger">{{ ($errors->first('email') ? $errors->first('email') : '') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Senha <span class="text-danger">{{ empty($usuario) ? "*" : '' }}</span> </label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" placeholder="Digite sua senha..." {{ empty($usuario) ? 'required' : '' }} />
                            <span class="text-danger">{{ ($errors->first('password') ? $errors->first('password') : '') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirmar Senha <span class="text-danger">{{ empty($usuario) ? "*" : '' }}</span> </label>
                        <div class="col-sm-8">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme sua senha..." {{ empty($usuario) ? 'required' : '' }} />
                            <span class="text-danger">{{ ($errors->first('password_confirmation') ? $errors->first('password_confirmation') : '') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3" style="margin-right: 12px;"></div>
                        <label class="ckbox ckbox-primary col-sm-8">
                            <input type="checkbox" {{ !empty($usuario) && $usuario->active == 1 ? 'checked' : '' }} name="active"><span>Ativar Esse Usuário</span>
                        </label>
                    </div>
                    <span class="info"><i class="fa fa-info-circle" style="font-size: 14px;"></i> &nbsp;Todos os campos com <strong style="font-size: 20px;">" * "</strong> são obrigatórios</span><br>
                    <span class="info"><i class="fa fa-info-circle" style="font-size: 14px;"></i> &nbsp;O Usuário so terá acesso ao sistema se marcado como ativo.</span>
                    <hr>

                    <div class="row">
                        <div class="col-sm-8 pull-right col-sm-offset-3">
                            <button class="btn btn-success btn-quirk btn-wide mr5">{{ !empty($usuario) ? 'Atualizar' : 'Cadastrar' }}</button>
                            <button type="reset" class="btn btn-quirk btn-wide btn-default">Limpar</button>
                        </div>
                    </div>

                </form>
            </div><!-- panel-body -->
        </div><!-- panel -->
    </div>

    <!-- content goes here... -->
@stop
