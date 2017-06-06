@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
    <h1>Contatos <a href="{{ url('/contato/create') }}" class="btn btn-primary pull-right">Add New Contato</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Mensagem</th>
                <th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($contatos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->telefone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mensagem }}</td>
                    <td><a href="{{ url('/contato/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> / {!! Form::open(['method'=>'delete','action'=>['ContatoController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>
    </div>

@endsection
