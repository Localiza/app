@extends('layouts.site')

@section('content')
    <section class="result">
        <div class="container" >
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        <h1>Fale conosco</h1>
                        <hr/>
                        <h3 class="panel-title">Aguardamos seu contato</h3>
                    </div>
                    <div class="panel-body">
                        <p class="nomargin">Preencha o formulário ao lado e nos encaminhe sua mensagem.</p><p>Caso preferir, pode entrar em contato diretamente em nossa caixa de email: <b>contato@guialocaliza.com.br</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                {!! Form::open(['url' => 'contato', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('nome', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    </div>
                </div><div class="form-group">
                    {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div><div class="form-group">
                    {!! Form::label('telefone', 'Telefone: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('telefone', null, ['class' => 'form-control phone']) !!}
                    </div>
                </div><div class="form-group">
                    {!! Form::label('mensagem', 'Mensagem: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('mensagem', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Envair', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            </div>
            </div>
        </div>
    </section>
@endsection
