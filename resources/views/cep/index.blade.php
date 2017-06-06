@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>CEPs <a href="{{ url('/cep/create') }}" class="btn btn-primary pull-right btn-sm">Novo Bairro</a></h1>
            <hr>
            <div class="table">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>CEP</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($dados as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td><a href="{{ url('/cep', $item->id) }}">{{ $item->name }}</a></td>
                            <td><a href="{{ url('/cep/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a> {!! Form::open(['method'=>'delete','action'=>['CepController@destroy',$item->id], 'style' => 'display:inline','onsubmit' => 'return confirmDelete()']) !!}<button type="submit" class="btn btn-danger btn-xs">Deletar</button>{!! Form::close() !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    </div>

@endsection
