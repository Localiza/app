@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>Edit Cidade</h1>
            <hr/>

            {!! Form::model($cidade, ['method' => 'PATCH', 'action' => ['CidadeController@update', $cidade->id], 'class' => 'form-horizontal','files' => true]) !!}

                {!! Form::token() !!}
                {!! Form::text('estado_id', null, ['class' => 'form-control','style' => 'display:none']) !!}
                {!! Form::text('active', null, ['class' => 'form-control','style' => 'display:none']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Cidade: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <p>Imagem: 1920x170px</p>
                    {!! Form::file('imagem', null) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
    </div>
</div>

@endsection
