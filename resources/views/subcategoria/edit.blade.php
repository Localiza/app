@extends('layouts.master')

@section('content')

    <h1>Editar Sub-categoria</h1>
    <hr/>

    {!! Form::model($subcategorium, ['method' => 'PATCH', 'action' => ['SubcategoriaController@update', $subcategorium->id], 'class' => 'form-horizontal']) !!}

    <div class="form-group">
                        {!! Form::label('categoria_id', 'Categoria Id: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('categoria_id', $categorias, null, array('class' => 'form-control')) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('nome', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Editar', ['class' => 'btn btn-primary form-control']) !!}
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
