@extends('layouts.master')

@section('content')

    <div class="panel">
        <div class="panel-body">
            <h1>Planos <a href="{{ url('/plano/create') }}" class="btn btn-primary pull-right btn-sm">Nova Plano</a></h1>
            <hr>
            <div class="table">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor (R$)</th>
                        <th>Ativo</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
            @foreach($planos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td><a href="{{ url('/plano', $item->id) }}">{{ $item->name }}</a></td>
                    <td><a href="{{ url('/plano', $item->id) }}">{{ $item->value }}</a></td>
                    <td>
                        <div style="display: none">{{ $item->active }}</div>
                        <div class="toggle-wrapper">
                            <div class="toggle toggle-light success ativo{{$item->id}}"></div>
                        </div>
                    </td>
                    <script>
                        $('.ativo{{$item->id}}').toggles({
                            on: {{ $item->active }},
                            text: {
                                on: 'SIM', // text for the ON position
                                off: 'NÂO' // and off
                            },
                            height: 26
                        }).on('toggle', function (e, active) {
                            $.ajax({
                                url: "/plano/active/{{$item->id}}",
                                type: 'GET',
                                dataType: 'html'
                            });
                        });
                    </script>
                    <td><a href="{{ url('/plano/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a> {!! Form::open(['method'=>'delete','action'=>['PlanoController@destroy',$item->id], 'style' => 'display:inline', 'onsubmit' => 'return confirmDelete()']) !!}<button type="submit" class="btn btn-danger btn-xs">Deletar</button>{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
