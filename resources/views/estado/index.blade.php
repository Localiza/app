@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
    <h1>Estados</h1>
            <hr>
    <div class="table">
        <table class="table table-bordered table-striped table-hover dataTable">
            <thead>
            <tr>
                <th>Cod.</th>
                <th>UF</th>
                <th>Nome</th>
                <th>Ativo</th>

            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($estados as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/estado', $item->id) }}">{{ $item->uf }}</a></td>
                    <td><a href="{{ url('/estado', $item->id) }}">{{ $item->name }}</a></td>
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
                                url: "/estado/active/{{$item->id}}",
                                type: 'GET',
                                dataType: 'html'
                            });
                        });
                    </script>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection
