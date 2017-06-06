@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
    <h1>Sub-categoria <a href="{{ url('/subcategoria/create') }}" class="btn btn-primary pull-right btn-sm">Nova Sub-categoria</a></h1>
            <hr>
    <div class="table">
        <table class="table table-bordered table-striped table-hover dataTable">
            <thead>
            <tr>
                <th>SL.</th>
                <th>Categoria</th>
                <th>Nome</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($subcategorias as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/categoria', $item->categoria_id) }}">{{ $item->categoria->name }}</a></td>
                    <td><a href="{{ url('/subcategoria', $item->id) }}">{{ $item->nome }}</a></td>
                    <td><a href="{{ url('/subcategoria/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a>
                    {!! Form::open(['method'=>'delete','action'=>['SubcategoriaController@destroy',$item->id], 'style' => 'display:inline', 'onsubmit' => 'return confirmDelete()']) !!}<button type="submit" class="btn btn-danger btn-xs">Deletar</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
