@extends('layouts.master')

@section('content')

    <h1>Create New Plano</h1>
    <hr/>

    {!! Form::open(['url' => 'plano', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
                        {!! Form::label('name', 'Plano: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('value', 'Valor: ', ['class' => 'col-sm-3 control-label ']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('value', null, ['class' => 'form-control currency']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('active', 'Active: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('active', 1, ['class' => 'form-control','style'=>'display:none']) !!}
                            <div class="toggle-wrapper">
                                <div class="toggle toggle-light success ativo"></div>
                            </div>
                        </div>

                    </div>
                    <script>
                        $('.ativo').toggles({
                            on: 1,
                            text: {
                                on: 'SIM', // text for the ON position
                                off: 'NÂO' // and off
                            },
                            height: 26
                        }).on('toggle', function (e, active) {
                            var tmp   =  active ? 1 :0;
                            $("#active").val(tmp);
                        });
                    </script>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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
