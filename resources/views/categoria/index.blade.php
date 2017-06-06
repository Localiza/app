@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
                <h1>Categorias <a href="{{ url('/categoria/create') }}" class="btn btn-primary pull-right btn-sm">Nova Categoria</a></h1>
            <hr>
                    <table id="dataTable1" class="table table-bordered table-responsive dataTable">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        {{-- */$x=0;/* --}}
                        @foreach($categorias as $item)
                            {{-- */$x++;/* --}}
                            <tr>
                                <td>{{ $x }}</td>
                                <td><a href="{{ url('/categoria', $item->id) }}">{{ $item->name }}</a></td>
                                <td><a href="{{ url('/categoria/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a> {!! Form::open(['method'=>'delete','action'=>['CategoriaController@destroy',$item->id], 'style' => 'display:inline', 'onsubmit' => 'return confirmDelete()']) !!}<button type="submit" class="btn btn-danger btn-xs">Deletar</button>{!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
        </div>
    </div>
@endsection
