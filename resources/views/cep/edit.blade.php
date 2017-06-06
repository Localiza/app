@extends('layouts.master')

@section('content')

    <h1>Editar cep</h1>
    <hr/>

    {!! Form::model($cep, ['method' => 'PATCH', 'action' => ['CepController@update', $cep->id], 'class' => 'form-horizontal']) !!}

    <div class="form-group">
                        <div class="form-group">
                        {!! Form::label('name', 'CEP: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('name', null, ['class' => 'form-control cep']) !!}
                        </div>    
                    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary form-control']) !!}
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

@endsection
